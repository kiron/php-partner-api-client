# PHP Client for the Kiron Partner API

Simple client for the Kiron Partner API to manage courses

# Usage

## Getting a valid token for authentification

A token for the **test system** can be created here: 

[https://uat-internal.kiron.ngo/backend/kiron/organization/partnerapitokens](https://uat-internal.kiron.ngo/backend/kiron/organization/partnerapitokens)

A token for the **production system** can be created here: 

[https://internal.kiron.ngo/backend/kiron/organization/partnerapitokens](https://internal.kiron.ngo/backend/kiron/organization/partnerapitokens) 

## Example code

```PHP
<?php

require_once 'KironPartnerAPIClient.php'; // Require class

$client = new KironPartnerAPIClient('tokenfrombackend', 'UAT'); // Init client
$client->createOrUpdateCourse('200', [
    'denomination' => 'Test Course',
    'ects' => 5,
    'link' => 'http://example.com/course',
    'language' => 'German',
    'startDateSemesterTwo' => '2020-12-10',
    'endDateSemesterTwo' => '2021-02-04',
])); // Create or update course, for attirbutes see below

$client->getSections(); // Returns array of all sections
$client->getCourses(); // Returns array of all courses
$client->getCourse('200'); // Returns coruse with id 200
$client->deleteCourse('200'); // Deletes course with id 200
```

## Methods

### `public function __construct(string $token, string $env = 'UAT')`
**Params:**

 - `$token` is a valid token obtained in the backend
 - `$env` is one of:
 	- 	'LOCAL' (Local development system of Kiron), 
 	-  'UAT' (Test System), 
 	-  'PROD' (Production system)

**Returns** client object

### `public function createOrUpdateCourse(string $id, array $attributes)`

**Params:**

 - `$id` id of the course in the partner system (also called "externalId")
 - `$attributes` array of course attributes, see [here](#course-attributes) for a description of all possible attributes

**Returns** response array:

 - If course was created: `['response' => 'Created course as JSON string', 'code' => 200, 'successful' => true]`
 - If course was updated: `['response' => '', 'code' => 204, 'successful' => true]`
 - On error `['response' => 'Error message', 'code' => (A number >= 400), 'successful' => false]`

### `public function getSections()`

**No params**

**Returns** list of sections with the following attributes:

 - id: Id of the section
 - denomination: Name of the section
 - path: Name of the category / name of the secion

 
### `public function getCourses()`

**No params**

**Returns list of courses with all attributes listed [here](#course-attributes) and the id in the partner system as externalId**

**Throws an Exception when list cannot be found retrieved!**

### `public function getCourse(string $id)`
**Params:**

 - `$id` id of the course in the partner system (also called "externalId")

**Returns** course with the given id with all attributes listed [here](#course-attributes) and given id as externalId

**Throws an Exception when course cannot be found!**

### `public function deleteCourse(string $id)`

**Params:**

 - `$id` id of the course in the partner system (also called "externalId")

**Returns** response array:

 - If course was deleted: `['response' => '', 'code' => 204, 'successful' => true]`
 - On error `['response' => 'Error message', 'code' => (A number >= 400), 'successful' => false]`

## Course Attributes

| Property                                        | Type      | Required  |
| :---------------------------------------------- | --------- | --------  |
| [denomination](#denomination)                   | `string`  | Required  |
| [ects](#ects)                                   | `integer` | Required  |
| [workload](#workload)                           | `number`  | Optional  |
| [weeks](#weeks)                                 | `integer` | Optional  |
| [link](#link)                                   | `string`  | Required  |
| [language](#language)                           | `string`  | Required  |
| [sectionId](#sectionid)                         | `integer` | Optional  |
| [courseLevel](#courselevel)                     | `string`  | Optional  |
| [certificateType](#certificatetype)             | `string`  | Optional  |
| [certificateCost](#certificatecost)             | `string`  | Optional  |
| [registrationDeadline](#registrationdeadline)   | `string`  | Optional  |
| [degreeLevel](#degreelevel)                     | `string`  | Optional  |
| [yufeFocusArea](#yufefocusarea)                 | `string`  | Optional  |
| [physicalOrVirtual](#physicalorvirtual)         | `string`  | Optional  |
| [studyProgramYear](#studyprogramyear)           | `string`  | Optional  |
| [semesterOffered](#semesteroffered)             | `string`  | Optional  |
| [startDateSemesterOne](#startdatesemesterone)   | `string`  | Optional*  |
| [endDateSemesterOne](#enddatesemesterone)       | `string`  | Optional*  |
| [startDateSemesterTwo](#startdatesemestertwo)   | `string`  | Optional*  |
| [endDateSemesterTwo](#enddatesemestertwo)       | `string`  | Optional*  |
| [courseExaminationType](#courseexaminationtype) | `string`  | Optional  |
| [availableSeats](#availableseats)               | `integer` | Optional  |
| [dublinDescriptors](#dublindescriptors)         | `string`  | Optional  |
| [admissionCriteria](#admissioncriteria)         | `string`  | Optional  |
| [courseCoordinator](#coursecoordinator)         | `string`  | Optional  |
| [shortDescription](#shortdescription)           | `string`  | Optional  |
| [longDescription](#longdescription)             | `string`  | Optional  |
| [imageUrl](#imageurl)                           | `string`  | Optional  |

*Note that not all start and end dates are optional at the same time. At least one set of start and end dates must be provided for the first or second semester

## denomination

The name of the course.

`denomination`

- is required
- Type: `string`
- cannot be null
- defined in: [Course](partnerapi-properties-denomination.md 'https://campus.kiron.ngo/backend/partner-api/course/schema.json#/properties/denomination')

### denomination Type

`string`

## ects

Amount of ECTS awarded for the completion of this course.

`ects`

- is required
- Type: `integer`
- cannot be null
- defined in: [Course](partnerapi-properties-ects.md 'https://campus.kiron.ngo/backend/partner-api/course/schema.json#/properties/ects')

### ects Type

`integer`

## workload

Estimated amount of hours of work needed to complete the course. Defaults to 30\*ects if not provided.

`workload`

- is optional
- Type: `number`
- cannot be null
- defined in: [Course](partnerapi-properties-workload.md 'https://campus.kiron.ngo/backend/partner-api/course/schema.json#/properties/workload')

### workload Type

`number`

## weeks

How many weeks does this course run? Will be calculated from start and end dates if not provided

`weeks`

- is optional
- Type: `integer`
- cannot be null
- defined in: [Course](partnerapi-properties-weeks.md 'https://campus.kiron.ngo/backend/partner-api/course/schema.json#/properties/weeks')

### weeks Type

`integer`

## link

Link to this course in the partner LMS.

`link`

- is required
- Type: `string`
- cannot be null
- defined in: [Course](partnerapi-properties-link.md 'https://campus.kiron.ngo/backend/partner-api/course/schema.json#/properties/link')

### link Type

`string`

### link Constraints

**URI**: the string must be a URI, according to [RFC 3986](https://tools.ietf.org/html/rfc3986 'check the specification')

## language

The name of the language that is spoken in this course.

`language`

- is required
- Type: `string`
- cannot be null
- defined in: [Course](partnerapi-properties-language.md 'https://campus.kiron.ngo/backend/partner-api/course/schema.json#/properties/language')

### language Type

`string`

## sectionId

Id of the section this course is shown in.

`sectionId`

- is optional
- Type: `integer`
- cannot be null
- defined in: [Course](partnerapi-properties-sectionid.md 'https://campus.kiron.ngo/backend/partner-api/course/schema.json#/properties/sectionId')

### sectionId Type

`integer`

## courseLevel

Difficulty level of this course.

`courseLevel`

- is optional
- Type: `string`
- cannot be null
- defined in: [Course](partnerapi-properties-courselevel.md 'https://campus.kiron.ngo/backend/partner-api/course/schema.json#/properties/courseLevel')

### courseLevel Type

`string`

### courseLevel Constraints

**enum**: the value of this property must be equal to one of the following values:

| Value            | Explanation |
| :--------------- | ----------- |
| `"Introductory"` |             |
| `"Intermediate"` |             |
| `"Advanced"`     |             |

## certificateType

`certificateType`

- is optional
- Type: `string`
- cannot be null
- defined in: [Course](partnerapi-properties-certificatetype.md 'https://campus.kiron.ngo/backend/partner-api/course/schema.json#/properties/certificateType')

### certificateType Type

`string`

### certificateType Constraints

**enum**: the value of this property must be equal to one of the following values:

| Value                      | Explanation |
| :------------------------- | ----------- |
| `"None"`                   |             |
| `"Verified Certificate"`   |             |
| `"Unverified Certificate"` |             |

## certificateCost

Cost of the certificate.

`certificateCost`

- is optional
- Type: `string`
- cannot be null
- defined in: [Course](partnerapi-properties-certificatecost.md 'https://campus.kiron.ngo/backend/partner-api/course/schema.json#/properties/certificateCost')

### certificateCost Type

`string`

### certificateCost Constraints

**enum**: the value of this property must be equal to one of the following values:

| Value    | Explanation |
| :------- | ----------- |
| `"Free"` |             |
| `"Paid"` |             |

## registrationDeadline

Date and time, when the registration for this courses closes.

`registrationDeadline`

- is optional
- Type: `string`
- cannot be null
- defined in: [Course](partnerapi-properties-registrationdeadline.md 'https://campus.kiron.ngo/backend/partner-api/course/schema.json#/properties/registrationDeadline')

### registrationDeadline Type

`string`

## degreeLevel

The degree level of the course.

`degreeLevel`

- is optional
- Type: `string`
- cannot be null
- defined in: [Course](partnerapi-properties-degreelevel.md 'https://campus.kiron.ngo/backend/partner-api/course/schema.json#/properties/degreeLevel')

### degreeLevel Type

`string`

## yufeFocusArea

`yufeFocusArea`

- is optional
- Type: `string`
- cannot be null
- defined in: [Course](partnerapi-properties-yufefocusarea.md 'https://campus.kiron.ngo/backend/partner-api/course/schema.json#/properties/yufeFocusArea')

### yufeFocusArea Type

`string`

## physicalOrVirtual

Information about the mode of the course. Can be any descriptive string.

`physicalOrVirtual`

- is optional
- Type: `string`
- cannot be null
- defined in: [Course](partnerapi-properties-physicalorvirtual.md 'https://campus.kiron.ngo/backend/partner-api/course/schema.json#/properties/physicalOrVirtual')

### physicalOrVirtual Type

`string`

## studyProgramYear

Which year should the students study this course.

`studyProgramYear`

- is optional
- Type: `string`
- cannot be null
- defined in: [Course](partnerapi-properties-studyprogramyear.md 'https://campus.kiron.ngo/backend/partner-api/course/schema.json#/properties/studyProgramYear')

### studyProgramYear Type

`string`

## semesterOffered

Semesters in which this course is offered.

`semesterOffered`

- is optional
- Type: `string`
- cannot be null
- defined in: [Course](partnerapi-properties-semesteroffered.md 'https://campus.kiron.ngo/backend/partner-api/course/schema.json#/properties/semesterOffered')

### semesterOffered Type

`string`

## startDateSemesterOne

Start date of the course in the first semester if applicable.

`startDateSemesterOne`

- is optional
- Type: `string`
- cannot be null
- defined in: [Course](partnerapi-properties-startdatesemesterone.md 'https://campus.kiron.ngo/backend/partner-api/course/schema.json#/properties/startDateSemesterOne')

### startDateSemesterOne Type

`string`

### startDateSemesterOne Constraints

**date**: the string must be a date string, according to [RFC 3339, section 5.6](https://tools.ietf.org/html/rfc3339 'check the specification')

## endDateSemesterOne

End date of the course in the first semester if applicable.

`endDateSemesterOne`

- is optional
- Type: `string`
- cannot be null
- defined in: [Course](partnerapi-properties-enddatesemesterone.md 'https://campus.kiron.ngo/backend/partner-api/course/schema.json#/properties/endDateSemesterOne')

### endDateSemesterOne Type

`string`

### endDateSemesterOne Constraints

**date**: the string must be a date string, according to [RFC 3339, section 5.6](https://tools.ietf.org/html/rfc3339 'check the specification')

## startDateSemesterTwo

Start date of the course in the second semester if applicable.

`startDateSemesterTwo`

- is optional
- Type: `string`
- cannot be null
- defined in: [Course](partnerapi-properties-startdatesemestertwo.md 'https://campus.kiron.ngo/backend/partner-api/course/schema.json#/properties/startDateSemesterTwo')

### startDateSemesterTwo Type

`string`

### startDateSemesterTwo Constraints

**date**: the string must be a date string, according to [RFC 3339, section 5.6](https://tools.ietf.org/html/rfc3339 'check the specification')

## endDateSemesterTwo

End date of the course in the second semester if applicable.

`endDateSemesterTwo`

- is optional
- Type: `string`
- cannot be null
- defined in: [Course](partnerapi-properties-enddatesemestertwo.md 'https://campus.kiron.ngo/backend/partner-api/course/schema.json#/properties/endDateSemesterTwo')

### endDateSemesterTwo Type

`string`

### endDateSemesterTwo Constraints

**date**: the string must be a date string, according to [RFC 3339, section 5.6](https://tools.ietf.org/html/rfc3339 'check the specification')

## courseExaminationType

`courseExaminationType`

- is optional
- Type: `string`
- cannot be null
- defined in: [Course](partnerapi-properties-courseexaminationtype.md 'https://campus.kiron.ngo/backend/partner-api/course/schema.json#/properties/courseExaminationType')

### courseExaminationType Type

`string`

## availableSeats

Seats available for YUFE incomings (positive integer)

`availableSeats`

- is optional
- Type: `integer`
- cannot be null
- defined in: [Course](partnerapi-properties-availableseats.md 'https://campus.kiron.ngo/backend/partner-api/course/schema.json#/properties/availableSeats')

### availableSeats Type

`integer`

## dublinDescriptors

Learning outcomes of this course

`dublinDescriptors`

- is optional
- Type: `string`
- cannot be null
- defined in: [Course](partnerapi-properties-dublindescriptors.md 'https://campus.kiron.ngo/backend/partner-api/course/schema.json#/properties/dublinDescriptors')

### dublinDescriptors Type

`string`

## admissionCriteria

Requirements the students need to fulfill in order to study this course.

`admissionCriteria`

- is optional
- Type: `string`
- cannot be null
- defined in: [Course](partnerapi-properties-admissioncriteria.md 'https://campus.kiron.ngo/backend/partner-api/course/schema.json#/properties/admissionCriteria')

### admissionCriteria Type

`string`

## courseCoordinator

Person or institute responsible for running this course.

`courseCoordinator`

- is optional
- Type: `string`
- cannot be null
- defined in: [Course](partnerapi-properties-coursecoordinator.md 'https://campus.kiron.ngo/backend/partner-api/course/schema.json#/properties/courseCoordinator')

### courseCoordinator Type

`string`

## shortDescription

Optional description of the course.

`shortDescription`

- is optional
- Type: `string`
- cannot be null
- defined in: [Course](partnerapi-properties-shortdescription.md 'https://campus.kiron.ngo/backend/partner-api/course/schema.json#/properties/shortDescription')

### shortDescription Type

`string`

## longDescription

Optional longer description of the course.

`longDescription`

- is optional
- Type: `string`
- cannot be null
- defined in: [Course](partnerapi-properties-longdescription.md 'https://campus.kiron.ngo/backend/partner-api/course/schema.json#/properties/longDescription')

### longDescription Type

`string`

## imageUrl

URL of an image for the course.

`imageUrl`

- is optional
- Type: `string`
- cannot be null
- defined in: [Course](partnerapi-properties-imageurl.md 'https://campus.kiron.ngo/backend/partner-api/course/schema.json#/properties/imageUrl')

### imageUrl Type

`string`

### imageUrl Constraints

**URI**: the string must be a URI, according to [RFC 3986](https://tools.ietf.org/html/rfc3986 'check the specification')
