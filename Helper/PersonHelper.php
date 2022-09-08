<?php

namespace CRUD\Helper;

use CRUD\Model\Person;

class PersonHelper
{
    public function insertPerson(Person $person)
    {
        /** @var DBConnector $dbHelper */
        $dbHelper = new DBConnector();
        $dbHelper->connect();
        $sql = "INSERT INTO person (first_name, last_name, username, the_password) VALUES ('" . $person->getFirstName() . "', '" . $person->getLastName() . "', '" . $person->getUsername() . "', '" . $person->getPassword() . "')";
        if ($dbHelper->execQuery($sql)) {
            echo "Record added successfully";
        } else {
            echo "An Error Occurred";
        }
    }

    public function fetchPerson(string $username, string $password)
    {
        //$person = new Person();
        $isAvailable = false;
        /** @var DBConnector $dbHelper */
        $dbHelper = new DBConnector();
        $dbHelper->connect();
        $sql = "SELECT * FROM person WHERE username='" . $username . "' AND the_password='" . $password . "'    ";
        $result = $dbHelper->execQuery($sql);
        if ($result->num_rows > 0) {
            $isAvailable = true;
            // $row = $result->fetch_all(MYSQLI_ASSOC);
            // $person->setId($row[0]['id']);
            // $person->setUsername($row[0]['username']);
            // $person->setPassword($row[0]['the_password']);
            // $person->setFirstName($row[0]['first_name']);
            // $person->setLastName($row[0]['last_name']);
        }
        return $isAvailable;
    }
}
