<?php
include('connection.php');

// Process form submission
if(isset($_POST['go'])) {
    // List of agents
 $agents = [
    "Eregeb",
    "Kidane Meheret",
    "Montosoriya",
    "Kidus Michael",
    "International Marif",
    "Magic",
    "Lemlem",
    "Kebena Adventist",
    "Andenet International School",
    "Kefetegna 12",
    "Kokeb Tsebah",
    "Berhan Guzo",
    "Tesfa Berhan",
    "Millennium",
    "Karaolo",
    "Beteseb Academy",
    "Joint Vision",
    "Tigat",
    "Resi Abel",
    "Meweda",
    "Yehemdar",
    "Alpha Keraniyo",
    "Teweled Tesfa",
    "Akaki Kaleheyewot",
    "Merit Secondary",
    "Awoliya No.2",
    "Olive",
    "Renaissance",
    "Bikolos",
    "Moonlight",
    "Victory",
    "Passion",
    "Lebawo International",
    "Atlas",
    "Abune Basleyos",
    "Hedasse",
    "Resi",
    "Ayer Tena",
    "Yemane Berhan"
];


    // Prepare SQL statement
    $stmt = $conn3->prepare("
        INSERT INTO agent (Type, parent_id, username, agent_id, phone_no, password, status)
        VALUES (0, 0, ?, ?, '0912345678', 'cda15f4a2b919c5cb84b74829b680e0c', 0)
    ");

    if ($stmt === false) {
        die("Error preparing statement: " . $conn3->error);
    }

    // Bind parameters
    $stmt->bind_param("ss", $username, $agent_id);

    // Insert data
    $success_count = 0;
    foreach ($agents as $agent) {
        $username = $agent;
        $agent_id = $agent;  // Set agent_id to the same value as username
        
        if ($stmt->execute()) {
            $success_count++;
        } else {
            echo "Error inserting " . $username . ": " . $stmt->error . "<br>";
        }
    }

    // Show success message
    echo "<div style='padding:10px; background:#dff0d8; color:#3c763d; margin:10px;'>
            Successfully inserted $success_count records!
          </div>";

    // Close statement
    $stmt->close();
}

// Close connection
$conn3->close();
?>

<!-- HTML Form -->
<form method="post">
    <button type="submit" name="go" style="padding: 10px 20px; background: #4CAF50; color: white; border: none; cursor: pointer;">
        INSERT AGENTS
    </button>
</form>