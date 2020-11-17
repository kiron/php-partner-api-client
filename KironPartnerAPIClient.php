<?php

class KironPartnerAPIClient
{

    private $_environments = [
        'LOCAL' => 'http://kiron-graphql:1337/backend/partner-api/',
        'UAT' => 'https://uat-campus.kiron.ngo/backend/partner-api/',
        'PROD' => 'http://campus.kiron.ngo/backend/partner-api/',
    ];

    private $_token;
    private $_currentEnv;

    public function __construct(string $token, string $env = 'UAT')
    {
        if (!array_key_exists($env, $this->_environments)) {
            throw new Error('Invalid environment given chose one of: ' . implode(', ', array_keys($this->_environments)));
        }
        $this->_token = $token;
        $this->_currentEnv = $env;
    }

    public function createOrUpdateCourse($id, $attributes)
    {
        return $this->_request('course/' . $id, 'PUT', $attributes);
    }

    public function getSections()
    {
        $result = $this->_request('section/', 'GET');
        if ($result['code'] === 200) {
            return json_decode($result['response']);
        }
        throw new Error('Could not retrieve sections. HTTP Status:' . $result['code'] . ' Response: ' . $result['response']);
    }

    public function getCourses()
    {
        $result = $this->_request('course/', 'GET');
        if ($result['code'] === 200) {
            return json_decode($result['response']);
        }
        throw new Error('Could not retrieve courses. HTTP Status:' . $result['code'] . ' Response: ' . $result['response']);
    }

    public function getCourse($id)
    {
        $result = $this->_request('course/' . $id, 'GET');
        if ($result['code'] === 200) {
            return json_decode($result['response']);
        }
        throw new Error('Could not retrieve course with id: ' . $id . ' HTTP Status:' . $result['code'] . ' Response: ' . $result['response']);
    }

    public function deleteCourse($id)
    {
        return $this->_request('course/' . $id, 'DELETE');
    }

    private function _request(string $path, string $method, array $fields = [])
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => $this->_environments[$this->_currentEnv] . $path,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_CUSTOMREQUEST => $method,
            CURLOPT_POSTFIELDS => json_encode($fields),
            CURLOPT_HTTPHEADER => array(
                "Content-Type: application/json",
                "Authorization: " . $this->_token,
            ),
        ));
        $response = curl_exec($curl);
        if (curl_errno($curl)) {
            throw new Error(curl_error($curl));
        }
        $http_code = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        curl_close($curl);
        return [
            'response' => $response,
            'code' => $http_code,
            'successful' => $http_code < 400,
        ];
    }

}
