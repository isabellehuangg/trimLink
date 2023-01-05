<?php 
    include "php/config.php";
    $new_link = "";
    if (isset($_GET)) {
        foreach($_GET as $key => $val) {
            $u = mysqli_real_escape_string($conn, $key);
            $new_link = str_replace('/', '', $u);
        }

        $sql = mysqli_query($conn, "SELECT long_link FROM urls WHERE trim_link = '{$new_link}'");
        if (mysqli_num_rows ($sql) > 0) {
            $clicks = mysqli_query($conn, "UPDATE urls SET clicks = clicks + 1 WHERE trim_link = '{$new_link}'");
            if ($clicks) {
                $long_link = mysqli_fetch_assoc($sql);
                header("Location:".$long_link['long_link']); 
            }
        }
    }
?>

<!DOCTYPE html>
<!-- URL Shortener -->

<html lang = "en">
    <head>
        <meta charset = "UTF-8">
        <title>trimLink</title>
        <link rel = "stylesheet" href = "styles.css">
        <link rel = "stylesheet" href = "https://unicons.iconscout.com/release/v3.0.6/css/line.css">
    </head>

    <body>
    <div class = "wrap">
            <h1>TrimLink</h1>
            <form action = "#">
                <input type = "text" name = "long-url" placeholder = "Enter a looong URL..." required>
                <i class = "url-icon uil uil-link"></i>
                <button>Trim</button>
            </form>
                <?php
                    $sql2 = mysqli_query($conn, "SELECT * FROM urls ORDER BY id DESC");
                    if (mysqli_num_rows($sql2) > 0) {
                    ?>
                    <div class = "count">
                        <?php 
                            $sql3 = mysqli_query($conn, "SELECT COUNT(*) FROM urls");
                            $total_links = mysqli_fetch_assoc($sql3);

                            $sql4 = mysqli_query($conn, "SELECT clicks FROM urls");
                            $total_clicks = 0;
                            while ($temp = mysqli_fetch_assoc($sql4)) {
                                $total_clicks = $temp['clicks'] + $total_clicks;
                            }
                        ?>
                        <span>Total Links: <span><?php echo end($total_links) ?></span>, Total Clicks: <span><?php echo $total_clicks ?></span></span> 
                        <a href="php/delete.php?delete=all" class = "clear">Clear All Links</a>
                    </div>
                    <div class = "url-tbl">
                        <div class = "titles">
                            <li>Trimmed Link</li>
                            <li>Original Link</li>
                            <li>Clicks</li>
                            <li>Action</li>
                        </div>
                        <?php
                        while ($row = mysqli_fetch_assoc($sql2)) {
                            ?>
                                <div class = "data">
                                    <li>
                                        <a href = "http://<?php echo $row['trim_link']?>" target = "_blank">
                                            <?php 
                                                if ('localhost/trimLink/' . $row['trim_link'] > 50) {
                                                    echo 'localhost/trimLink/'.substr($row['trim_link'], 0, 50);
                                                } else {
                                                    echo 'localhost/trimLink/'.$row['trim_link'];
                                                }
                                            ?>
                                        </a>
                                    </li>
                                    <li>
                                        <?php 
                                            if (strlen($row['long_link']) > 50) {
                                                echo substr($row['long_link'], 0, 50). '...';
                                            } else {
                                                echo $row['long_link'];
                                            }
                                            ?>
                                    </li>
                                    <li><?php echo $row['clicks'] ?></li>
                                    <li><a href="php/delete.php?id=<?php echo $row['trim_link'] ?>">Delete</a></li>
                                </div>
                            <?php
                        }
                    }
                    ?>
                    </div> 
        </div>

        <div class = "blur"></div>

        <div class = "popup">
            <div class = "info"> Your trimmed link is ready. To copy the trimmed link, replace "?u=" with "/" below:</div>
            <form action = "#" autocomplete="off">
                <label>Edit your link:</label>
                <input type = "text" class = "trim-link" spellcheck = "false" value = "">
                <i class = "copy-icon uil uil-copy-alt"></i>
                <button>Save</button>
            </form>
        </div>

        <script src="script.js"></script>

    </body>
</html>