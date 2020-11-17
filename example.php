<?php

require_once 'KironPartnerAPIClient.php';

$client = new KironPartnerAPIClient('XjsX5BdnE2bOlzS709aZ6cBE9uhkyhKyLLffrbb9UMQwYC9skb', 'LOCAL');
var_dump($client->createOrUpdateCourse(200, [
    'denomination' => 'Test Course',
    'ects' => 5,
    'link' => 'http://example.com/course',
    'language' => 'German',
    'startDateSemesterTwo' => '2020-12-10',
    'endDateSemesterTwo' => '2021-02-04',
]));

var_dump($client->getSections());
var_dump($client->getCourses());
var_dump($client->getCourse(200));
var_dump($client->deleteCourse(200));
