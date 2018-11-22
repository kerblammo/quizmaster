<?php
class ConnectionManager {

    public function connect_db() {
        $db = new PDO("[REDACTED - CX STRING]", "[REDACTED - USER]", "[REDACTED - PASSWORD]");
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $db;
    }

}