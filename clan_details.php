<?php
session_start();
if (!isset($_SESSION['logged'])) {
    header("Location: index.php");
    exit();
}
include("config.php");
$mysqli = new mysqli($DB_HOST, $DB_USER, $DB_PASS, $DB_NAME);
if ($mysqli->connect_errno) {
    echo "Database Connection Error!";
    exit();
}

$mtype = '';
$user_id = '';
$usn = $_SESSION['logged'];
$user_id = $_SESSION['id'];
$type = $_SESSION['type'];

$check = $mysqli->query("SELECT `type` FROM `user_table` WHERE `username` = '$usn'");
if ($check->num_rows > 0) {
    $mtype = $check->fetch_assoc()['type'];
    $type = $mtype;
    if ($mtype != "" || $mtype != "im") {

    } else {
        echo "You are in a penalty streak for not being an active member!";
        exit();
    }
}

if ($type == 'sat' || $type == 'cca') {
    ?>
    <!DOCTYPE html>
    <html>
    <head>
        <title>Clan Details : ACA Explorers</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <style type="text/css">
            .textarea {
                resize: none;
                width: auto;
                height: 300px;
            }

        </style>
        <!-- JQuery -->
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <!-- Bootstrap tooltips -->
        <script type="text/javascript"
                src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.4/umd/popper.min.js"></script>
        <!-- Bootstrap core JavaScript -->
        <script type="text/javascript"
                src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/js/bootstrap.min.js"></script>
        <!-- MDB core JavaScript -->
        <script type="text/javascript"
                src="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.8.5/js/mdb.min.js"></script>
        <!-- Font Awesome -->
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
        <!-- Bootstrap core CSS -->
        <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/css/bootstrap.min.css"
              rel="stylesheet">
        <!-- Material Design Bootstrap -->
        <link href="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.8.5/css/mdb.min.css" rel="stylesheet">

        <link href="functions/select2.css" media="all" rel="stylesheet" type="text/css">
        <script src="functions/select2.js" type="text/javascript"></script>
    </head>

    <body class="container"><br>
    <center>User: <?php echo $usn; ?> <h1>My Clan Details</h1><br>
        <button class="btn btn-primary" onclick="location.href='dashboard.php'">Back to Dashboard</button>
        <button class="btn btn-danger" onclick="location.href='logout.php'">Logout</button>
    </center>
    <br>
    <?php
    if ($type == 'sat' || $type == 'cca') {
        ?>
        <div class='msg_data'></div>
        <h3>Create New Clan</h3>
        <form class="form form-control-md form form-horizontal" method="post" role="form" id="clan_add">
            <table width="100%" class="table  table-bordered">
                <tr>
                    <td>Clan</td>
                    <td><input class="form-control" type="text" name="clan" id="clan" required>

                        <div id='clanError' class='red'></div>
                    </td>
                </tr>
                <tr>
                    <td>Description</td>
                    <td><textarea class="form-control" name="clan_description" id="clan_description"
                                  placeholder="Description">EWC:__</textarea></td>
                </tr>
                <tr>
                    <td>President</td>
                    <td>
                        <?php
                        $html = '';
                        $dataUsers = $mysqli->query("SELECT `*` FROM `user_table` ORDER BY username ASC ");
                        $html .= "<select class='form-control' name='president' id='president' required>
                            <option value='0'>--Select--</option>
                            ";
                        while ($rowUser = $dataUsers->fetch_assoc()) {
                            $html .= "<option value='{$rowUser['username']}'>{$rowUser['username']}</option>";
                        }
                        $html .= "</select>
                <div id='presidentError' class='red'>";
                        echo $html;
                        ?>
                    </td>
                </tr>
                <tr>
                    <td>Librarian</td>
                    <td>
                        <?php
                        $html = '';
                        $dataUsers = $mysqli->query("SELECT `*` FROM `user_table` ORDER BY username ASC ");
                        $html .= "<select class='form-control' name='librarian' id='librarian' required>
                            <option value='0'>--Select--</option>
                            ";
                        while ($rowUser = $dataUsers->fetch_assoc()) {
                            $html .= "<option value='{$rowUser['username']}'>{$rowUser['username']}</option>";
                        }
                        $html .= "</select>
                <div id='librarianError' class='red'>";
                        echo $html;
                        ?>
                    </td>
                </tr>
                <tr>
                    <td>Secretary</td>
                    <td>
                        <?php
                        $html = '';
                        $dataUsers = $mysqli->query("SELECT `*` FROM `user_table` ORDER BY username ASC ");
                        $html .= "<select class='form-control' name='secretary' id='secretary' required>
                            <option value='0'>--Select--</option>";
                        while ($rowUser = $dataUsers->fetch_assoc()) {
                            $html .= "<option value='{$rowUser['username']}'>{$rowUser['username']}</option>";
                        }
                        $html .= "</select>
                <div id='secretaryError' class='red'>";
                        echo $html;
                        ?>
                    </td>
                </tr>
                <tr>
                    <td>Treasurer</td>
                    <td>
                        <?php
                        $html = '';
                        $dataUsers = $mysqli->query("SELECT `*` FROM `user_table` ORDER BY username ASC ");
                        $html .= "<select class='form-control' name='treasurer' id='treasurer' >
                            <option value='0'>--Select--</option>";
                        while ($rowUser = $dataUsers->fetch_assoc()) {
                            $html .= "<option value='{$rowUser['username']}'>{$rowUser['username']}</option>";
                        }
                        $html .= "</select>
                <div id='treasurerError' class='red'>";
                        echo $html;
                        ?>
                    </td>
                    <td>Tracker</td>
                    <td>
                        <?php
                        $html = '';
                        $dataUsers = $mysqli->query("SELECT `*` FROM `user_table` ORDER BY username ASC ");
                        $html .= "<select class='form-control' name='tracker' id='tracker' >
                            <option value='0'>--Select--</option>";
                        while ($rowUser = $dataUsers->fetch_assoc()) {
                            $html .= "<option value='{$rowUser['username']}'>{$rowUser['username']}</option>";
                        }
                        $html .= "</select>
                <div id='treasurerError' class='red'>";
                        echo $html;
                        ?>
                    </td>
                </tr>
                
                <tr>
                    <td>Advisor</td>
                    <td>
                        <?php
                        $html = '';
                        $dataUsers = $mysqli->query("SELECT `*` FROM `user_table` ORDER BY username ASC ");
                        $html .= "<select class='form-control' name='advisors' id='advisors' multiple>";
                        while ($rowUser = $dataUsers->fetch_assoc()) {
                            $html .= "<option value='{$rowUser['username']}'>{$rowUser['username']}</option>";
                        }
                        $html .= "</select>
                <div id='advisorsError' class='red'>";
                        echo $html;
                        ?>
                    </td>
                </tr>
                <tr>
                    <td>Member</td>
                    <td>
                        <?php
                        $html = '';
                        $dataUsers = $mysqli->query("SELECT `*` FROM `user_table` ORDER BY username ASC ");
                        $html .= "<select class='form-control' name='member' id='member' multiple>";
                        while ($rowUser = $dataUsers->fetch_assoc()) {
                            $html .= "<option value='{$rowUser['username']}'>{$rowUser['username']}</option>";
                        }
                        $html .= "</select>
                <div id='memberError' class='red'>";
                        echo $html;
                        ?>
                    </td>
                </tr>
            </table>
            <center>
                <button type="button" class="btn btn-success text-white" onclick="addClan();"> Create New Clan</button>
                <button type="reset" class="btn btn-warning text-white"> Reset</button>
            </center>
        </form>

        <div id="clan_edit_page">
        </div>
        <?php
    }
    ?>
    <br>
    <table width="100%" class="table table-striped table-bordered">
        <thead>
        <th width="20%">
            Clan
        </th>
        <th width="20%">
            Description
        </th>
        <th width="30%">
            Users
        </th>

        <th width="30%">Actions</th>
        </thead>
        <tbody>
        <?php
        if ($type == 'sat' || $type == 'cca') {
            $query = "SELECT * FROM clan";
        } else {
            $query = "SELECT * FROM clan LEFT JOIN user_clan ON clan.clan_id = user_clan.clan_id WHERE user_clan.user_id ='$usn'";
        }
        //$query = "SELECT * FROM clan";
        $row = $mysqli->query($query);
        if ($row->num_rows > 0) {
            while ($data = $row->fetch_assoc()) {
                $clan_id = $data['clan_id'];
                $html = '';
                $html .= "<tr>
                <td width='20%'>
                    {$data['clan']}
                </td>
                <td width='20%'>
                    {$data['clan_description']}
                </td>
                <td width='30%'>";
                //get clan users
                $query = "SELECT * FROM user_clan WHERE clan_id ='$clan_id'";
                $rowUser = $mysqli->query($query);

                if ($rowUser->num_rows > 0) {
                    while ($dataUser = $rowUser->fetch_assoc()) {
                        $html .= "<strong>{$dataUser['designation']}: </strong>{$dataUser['user_id']}<br>";
                    }
                }
                $html .= "</td>
                <td width='30%'>
                    <button type='button' class='btn-success text-white btn-xs'  onclick=\"location.href='clan_dashboard.php?clan_id=$clan_id'\"> Go To Dashboard</button> ";
                if ($type == 'sat' || $type == 'cca') {
                    $html .= "<button type='button' class='btn-warning text-white btn-xs' onclick='getClan($clan_id);'> Edit</button>
                    <button type='button' class='btn-danger text-white btn-xs' onclick='deleteClan($clan_id);'> Delete</button>";
                }

                $html .= "</td>
            </tr>";
                echo $html;
            }
        } else {
            $html = '';
            $html = "<tr>
                <td colspan='3'>No data Found</td>

            </tr>";
            echo $html;
        }

        ?>
        </tbody>
    </table>

    <br> <br> <br>
    </body>
    </html>
    <?php
} else {
    $query = "SELECT * FROM clan LEFT JOIN user_clan ON clan.clan_id = user_clan.clan_id WHERE user_clan.user_id ='$usn'";
    $row = $mysqli->query($query);
    if ($row->num_rows > 0) {
        /*while ($data = $row->fetch_assoc()) {
            $clan_id = $data['clan_id'];
        }*/
        $data = $row->fetch_assoc();
        $clan_id = $data['clan_id'];
        header('Location: clan_dashboard.php?clan_id='.$clan_id);
    } else {
        echo 'No clan for you';
        exit;
    }
}
?>
<script src="functions/validate.js" type="text/javascript"></script>

<script>
    $("#advisors").select2();
    $("#member").select2();
    $('#clan_edit_page').hide();

    function addClan() {
        var msg = '<div class="alert alert-success text-center">' +
            '<a class="close" href="#" data-dismiss="alert">x </a>' +
            '<h4><i class="icon-ok-sign"></i><strong>Success!</strong> Data successfully saved' +
            '</div>';
        if (validateForm()) {
            $.ajax({
                type: "POST",
                url: "functions/functions.php",
                data: {
                    'fun_type': 'add',
                    'clan': $('#clan').val(),
                    'clan_description': $('#clan_description').val(),
                    'president': $('#president').val(),
                    'librarian': $('#librarian').val(),
                    'secretary': $('#secretary').val(),
                    'treasurer': $('#treasurer').val(),
                    'tracker': $('#tracker').val(),
                    'advisors': $('#advisors').val(),
                    'member': $('#member').val()
                },
                dataType: 'html',
                success: function (responce) {
                    if (responce == 'ok') {
                        $(".msg_data").html(msg);
                        var delay = 1500;
                        setTimeout(function () {
                            location.reload();
                        }, delay);
                    } else {
                        $(".msg_data").html(responce);
                    }

                }
            })
        }
    }

    function editClan() {
        var msg = '<div class="alert alert-success alert-dismissable">' +
            '<a class="close" href="#" data-dismiss="alert">x </a>' +
            '<h4><i class="icon-ok-sign"></i>Data successfully updated' +
            '</div>';
        //if (validateForm_edit()) {
        $.ajax({
            type: "POST",
            url: "functions/functions.php",
            data: {
                'id': $('#id').val(),
                'fun_type': 'edit',
                'clan': $('#c_edit').val(),
                'clan_description': $('#clan_description_edit').val(),
                'president': $('#president_edit').val(),
                'librarian': $('#librarian_edit').val(),
                'secretary': $('#secretary_edit').val(),
                'treasurer': $('#treasurer_edit').val(),
                'tracker': $('#tracker_edit').val(),
                'advisors': $('#advisors_edit').val(),
                'member': $('#member_edit').val()
            },
            dataType: 'html',
            success: function (responce) {
                if (responce == 'ok') {
                    $(".msg_data").html(msg);
                    var delay = 1500;
                    setTimeout(function () {
                        location.reload();
                    }, delay);
                } else {
                    $(".msg_data").html(responce);
                }
            }
        })
        //}
    }

    function getClan(id) {
        $('#clan_add').hide();
        $.ajax({
            type: "POST",
            url: "functions/functions.php",
            data: {
                'fun_type': 'get',
                'clan_id': id
            },
            dataType: 'html',
            success: function (responce) {
                $('#clan_edit_page').show();
                $('#clan_edit_page').html(responce);
                $("#advisors_edit").select2();
                $("#member_edit").select2();
                /*$(".msg_data").html(responce);
                 var delay=1500;
                 setTimeout(function() {
                 location.reload();
                 }, delay);*/
            }
        })
    }

    function deleteClan(id) {
        var bConfirm = confirm("Are you sure you want to delete this clan details");
        if (bConfirm) {
            $.ajax({
                type: "POST",
                url: "functions/functions.php",
                data: {
                    'fun_type': 'delete',
                    'clan_id': id
                },
                dataType: 'html',
                success: function (responce) {
                    $(".msg_data").html(responce);
                    var delay = 1500;
                    setTimeout(function () {
                        location.reload();
                    }, delay);
                }
            })
        }
    }

    function validateForm() {
        return (isNotEmpty("clan", "Clan field is required")
            && isSelected("president", "Please select president")
            && isSelected("librarian", "Please select librarian")
            && isSelected("secretary", "Please select secretary")
            && isSelected("treasurer", "Please select treasurer")
            && isSelected("tracker", "Please select tracker")
            /*&& isSelected("advisors", "Please select advisor")
             && isSelected("member", "Please select member")*/
        );
    }

    function validateForm_edit() {
        return (isNotEmpty("clan_edit", "Clan field is required")
            //&& isNotEmpty("user_id", "User field is required")
        );
    }


</script>
