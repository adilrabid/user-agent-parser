<?php

$agent = $_SERVER['HTTP_USER_AGENT'];
$get_browser = [];

if (isset($_POST['submit']) && isset($_POST['user_agent'])) {
    $agent = $_POST['user_agent'];
}

$browserArray = array(
    'Aloha Browser' => 'AlohaBrowser',
    'Yandex Browser' => 'YaBrowser',
    'Microsoft Edge' => 'Edg',
    'Opera' => array('OPR', 'OPX', 'OPT'),
    'Vivaldi' => 'Vivaldi',
    'Firefox' => array('Firefox', 'FxiOS'),
    "Samsung Browser" => 'SamsungBrowser',
    'Chrome' => array('Chrome', 'CriOS'),
    'Internet Explorer' => 'MSIE',
    'DuckDuckGo' => 'Ddg',
    'Safari' => 'Safari',
);

$get_browser['browser'] = "Other";

foreach ($browserArray as $k => $V) {
    if (is_array($V)){
        foreach ($V as $v){
            if (preg_match("/$v/", $agent)) {
                $get_browser['browser'] = $k;
                break 2;
            }
        }
    } else {
        if (preg_match("/$V/", $agent)) {
            $get_browser['browser'] = $k;
            break;
        }
    }
}

$platformArray = array(
    "Windows Phone" => "(Windows Phone)|(Microsoft; Lumia)",
    "Android" => "(Linux; Android)|Android",
    "ChromeOS" => "(X11; CrOS)",
    "SymbianOS" => "SymbianOS",
    'Windows 98' => '(Win98)|(Windows 98)',
    'Windows 2000' => '(Windows 2000)|(Windows NT 5.0)',
    'Windows ME' => 'Windows ME',
    'Windows XP' => '(Windows XP)|(Windows NT 5.1)',
    'Windows Vista' => 'Windows NT 6.0',
    'Windows 8' => 'Windows NT 6.2',
    'Windows 8.1' => 'Windows NT 6.3',
    'Windows 7' => '(Windows NT 6.1)|(Windows NT 7.0)',
    'Windows 10/11' => 'Windows NT 10.0',
    'Linux' => '(X11)|(Linux)',
    'iOS' => '(Apple-iPhone)|(iPhone)|(iPhone OS)',
    'macOS' => '(Mac_PowerPC)|(Macintosh)|(Mac OS)'
);
$get_browser['platform'] = "Other";
foreach ($platformArray as $k => $v) {
    if (preg_match("/$v/", $agent)) {
        $get_browser['platform'] = $k;
        break;
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <style>
    </style>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body class="bg-dark text-light">
<div class="container mt-5">
    <div style="font-size: 10px">
        <small class="text-muted">
            <?php echo "[CURRENT USER AGENT]:" . $_SERVER['HTTP_USER_AGENT']; ?>
        </small>
    </div>
    <br>
    <h2>USER AGENT PARSER</h2>
    <p>
        A custom made user agent parser made with PHP. It can recognize most of the popular operating systems and browsers.
    </p>
    <div class="mt-5">
        <form method="post" action="">
            <div class="mb-3">
                <label class="form-label">Enter user agent string you want to parse: </label>
                <div class="row">
                    <div class="col-10">
                        <input type="text" name="user_agent" class="form-control bg-dark text-light"
                               value="<?= isset($_POST['submit']) ? $_POST['user_agent'] : '' ?>">
                    </div>
                    <div class="col-2">
                        <button type="submit" name="submit" class="btn btn-primary" style="width: 100%">PARSE</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <br>
    <div>
        <h6 class="text-muted"><?= isset($_POST['submit']) ? "Parsed result" : "Current agent"; ?></h6>
        <div class="my-2">
            <span class="text-muted">Browser: </span>
            <span class="fw-bold"><?php echo $get_browser ? $get_browser["browser"] : '' ?></span>
        </div>
        <div class="my-2">
            <span class="text-muted">Platform: </span>
            <span class="fw-bold"><?php echo $get_browser ? $get_browser["platform"] : '' ?></span>
        </div>

    </div>
</div>
</body>
</html>
