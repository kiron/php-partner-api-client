<?php

require_once 'KironPartnerAPIClient.php';

// Replace the example token  XjsX5BdnE2bOlzS709aZ6cBE9uhkyhKyLLffrbb9UMQwYC9skb with your own token
$client = new KironPartnerAPIClient('XjsX5BdnE2bOlzS709aZ6cBE9uhkyhKyLLffrbb9UMQwYC9skb', 'LOCAL');
var_dump($client->createOrUpdateCourse('test_id-12', [
    'denomination' => 'Test Course',
    'ects' => 5,
    'link' => 'http://example.com/course',
    'language' => 'German',
    'startDateSemesterTwo' => '2020-12-10',
    'endDateSemesterTwo' => '2021-02-04',
]));

var_dump($client->getSections());
var_dump($client->getCourses());
var_dump($client->getCourse('test_id-12'));
var_dump($client->deleteCourse('test_id-12'));
