<html>
<body>
    <img src="60595.jpg" alt=""><br><br><br>
</body>
</html>

<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

/**
 * register Google Cloud Storage
 */
require '/home/ajith/vendor/autoload.php';


use Google\Cloud\Storage\StorageClient;
$storage = new StorageClient();
$storage->registerStreamWrapper();

# imports the Google Cloud client library
use Google\Cloud\Vision\V1\ImageAnnotatorClient;

# instantiates a client
$imageAnnotator = new ImageAnnotatorClient();

# the name of the image file to annotate
// $fileName = "gs://bigday-regional-mumbai/w_800/events/119/raw/43/images/9485.jpg";
$fileName = "60595.jpg";

# prepare the image to be annotated
$image = file_get_contents($fileName);

# performs label detection on the image file
$response = $imageAnnotator->labelDetection($image);
$labels = $response->getLabelAnnotations();

if ($labels) {
    echo("Labels:" . PHP_EOL);
    foreach ($labels as $label) {
        echo($label->getDescription() . PHP_EOL);
    }
} else {
    echo('No label found' . PHP_EOL);
}