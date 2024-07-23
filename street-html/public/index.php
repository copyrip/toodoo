<?php
$directories = glob('*', GLOB_ONLYDIR);

// Create an array to store directories with their creation times
$sortedDirs = array();
foreach ($directories as $dir) {
  $indexFile = $dir . '/index.html';
  if (file_exists($indexFile)) {
    $creationTime = filemtime($indexFile);
    $sortedDirs[$dir] = $creationTime;
  }
}

// Sort directories by creation time (newest first)
arsort($sortedDirs);

// Group directories by day
$groupedDirs = array();
foreach ($sortedDirs as $dir => $time) {
  $date = date('Y-m-d', $time);
  $groupedDirs[$date][$dir] = $time;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Website Thumbnails by Day</title>
    <style>
	.day-section {
	    margin-bottom: 30px;
	    border-bottom: 2px solid #ccc;
	    padding-bottom: 20px;
	}
	.day-title {
	    font-size: 1.5em;
	    color: #333;
	    margin-bottom: 15px;
	}
	.thumbnails-container {
	    display: flex;
	    flex-wrap: wrap;
	}
	.thumbnail-container {
	    margin: 10px;
	    border: 1px solid #ddd;
	    padding: 10px;
	    text-align: center;
	    width: 320px;
	}
	.thumbnail {
	    width: 300px;
	    height: 200px;
	    overflow: hidden;
	    position: relative;
	}
	.thumbnail iframe {
	    width: 1200px;
	    height: 800px;
	    border: 0;
	    transform: scale(0.25);
	    transform-origin: 0 0;
	}
	.creation-time {
	    font-size: 0.8em;
	    color: #666;
	    margin-top: 5px;
	}

#cal span {
border:solid red 3px;
border-radius:50%;
}
    </style>
</head>
<body>
    <h1>Website Thumbnails by Day</h1>
<pre id="cal">
prochaines sessions →

      July 2024     
Mo Tu We Th Fr Sa Su
 1  2  3  4  5  6  7
 8  9 10 11 12 13 14
15 16 17 18 19 20 21
22  x 24 25 26 27 <span>28</span>
29 30 31            
</pre>


    <?php foreach ($groupedDirs as $date => $dirs): ?>
	<section class="day-section">
	    <h2 class="day-title"><?= date("F j, Y", strtotime($date)) ?></h2>
	    <div class="thumbnails-container">
		<?php foreach ($dirs as $dir => $time): ?>
		    <div class="thumbnail-container">
			<h3><?= htmlspecialchars($dir) ?>'s Website</h3>
			<div class="thumbnail">
			    <iframe src="./<?= htmlspecialchars($dir) ?>/" scrolling="no"></iframe>
			</div>
			<div class="creation-time">
			    Created at: <?= date("H:i:s", $time) ?>
			</div>
		    </div>
		<?php endforeach; ?>
	    </div>
	</section>
    <?php endforeach; ?>

</body>
</html>
