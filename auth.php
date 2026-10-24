
<?php

$dataFile = __DIR__ . "/users.txt";

function hashPassword($password, $salt) {
    return hash("sha256", $password . $salt);
}

function registerUser($username, $password, $dataFile) {
    if ($username === "" || $password === "" || strpos($username, "|") !== false) {
        echo "Invalid username or password.\n";
        return;
    }

    // Check whether the username already exists
    if (file_exists($dataFile)) {
        $lines = file($dataFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

        foreach ($lines as $line) {
            $fields = explode("|", $line);

            if (count($fields) === 3 && $fields[0] === $username) {
                echo "Registration failed: username already exists.\n";
                return;
            }
        }
    }

    // Generate a random salt
    $salt = bin2hex(random_bytes(16));

    // Hash the password together with the salt
    $passwordHash = hashPassword($password, $salt);

    // Save username, salt, and hash in a text file
    $record = $username . "|" . $salt . "|" . $passwordHash . PHP_EOL;

    if (file_put_contents($dataFile, $record, FILE_APPEND | LOCK_EX) !== false) {
        echo "Registration successful!\n";
    } else {
        echo "Error: Could not write to the data file.\n";
    }
}

function loginUser($username, $password, $dataFile) {
    if (!file_exists($dataFile)) {
        echo "Login failed: no registered users.\n";
        return;
    }

    $lines = file($dataFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

    foreach ($lines as $line) {
        $fields = explode("|", $line);

        if (count($fields) !== 3) {
            continue;
        }

        $savedUsername = $fields[0];
        $savedSalt = $fields[1];
        $savedHash = $fields[2];

        if ($savedUsername === $username) {
            $enteredHash = hashPassword($password, $savedSalt);

            if (hash_equals($savedHash, $enteredHash)) {
                echo "Login successful!\n";
            } else {
                echo "Login failed: incorrect password.\n";
            }

            return;
        }
    }

    echo "Login failed: username not found.\n";
}

// Main program menu
while (true) {
    echo "\n===== Password Hashing System =====\n";
    echo "1. Register\n";
    echo "2. Login\n";
    echo "3. Display stored data\n";
    echo "4. Exit\n";
    echo "Choose an option: ";

    $choice = trim(fgets(STDIN));

    if ($choice === "1") {
        echo "Enter username: ";
        $username = trim(fgets(STDIN));

        echo "Enter password: ";
        $password = trim(fgets(STDIN));

        registerUser($username, $password, $dataFile);

    } elseif ($choice === "2") {
        echo "Enter username: ";
        $username = trim(fgets(STDIN));

        echo "Enter password: ";
        $password = trim(fgets(STDIN));

        loginUser($username, $password, $dataFile);

    } elseif ($choice === "3") {
        if (file_exists($dataFile)) {
            echo "\nStored data (username | salt | hash):\n";
            echo file_get_contents($dataFile);
        } else {
            echo "No data file exists yet. Register a user first.\n";
        }

    } elseif ($choice === "4") {
        echo "Goodbye!\n";
        break;

    } else {
        echo "Invalid choice. Please try again.\n";
    }
}
?>
