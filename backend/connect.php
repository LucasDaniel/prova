<?php

class Connect {
    // Properties
    public $host = "localhost";
    public $user = "lucasg96_lucasg9";
    public $password = "8OJ5gas2q6";
    public $database = "lucasg96_pesquisa";

    // Methods
    function set_host($host) {
      $this->host = $host;
    }
    function get_host() {
      return $this->host;
    }
    function set_user($user) {
        $this->user = $user;
    }
    function get_user() {
        return $this->user;
    }
    function set_password($password) {
        $this->password = $password;
    }
    function get_password() {
        return $this->password;
    }
    function set_database($database) {
        $this->database = $database;
    }
    function get_database() {
        return $this->database;
    }
}

?>