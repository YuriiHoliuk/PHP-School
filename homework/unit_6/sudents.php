<?php

class Student
{
    const GENDERS = ['male' => 'male', 'female' => 'female'];

    const STATUSES = ['freshman' => 'freshman', 'sophomore' => 'sophomore', 'junior' => 'junior', 'senior' => 'senior'];

    const MAX_GPA = 4;

    public function __construct(string $firstName, string $lastName, float $gpa, string $status = 'freshman', string $gender = 'male')
    {
        $this->_validate($firstName, $lastName, $gpa, $status, $gender);

        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->gpa = $gpa;
        $this->status = $status;
        $this->gender = $gender;
    }

    public function studyTime(float $time)
    {
        $calcTime = $this->gpa = log($time);
        $this->gpa = $calcTime <= self::MAX_GPA ? $calcTime : self::MAX_GPA;
        var_export($this->gpa);
    }

    public function showMyself()
    {
        var_export([
            'firstName' => $this->firstName,
            'lastName' => $this->lastName,
            'gpa' => $this->gpa,
            'status' => $this->status,
            'gender' => $this->gender,
        ]);
    }

    private function _validate($firstName, $lastName, $gpa, $status, $gender)
    {
        $errors = [];
        $genders = self::GENDERS;
        $statuses = self::STATUSES;

        if (empty($firstName)) {
            $errors['firstName'] = 'First name cannot be empty';
        }

        if (empty($lastName)) {
            $errors['lastname'] = 'Last name cannot be empty';
        }

        if ($gpa < 0) {
            $errors['gpa'] = 'GPA should be greater then 0';
        }

        if ($gpa > 4) {
            $errors['gpa'] = 'GPA should be less or equal then 4';
        }

        if (!in_array($gender, $genders, true)) {
            $errors['gender'] = 'Gender should be male or female';
        }

        if (!in_array($status, $statuses, true)) {
            $errors['status'] = 'Status should be one of freshman, sophomore, junior, senior';
        }
    }
}
