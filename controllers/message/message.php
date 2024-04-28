<?php

function message(){
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    if (!isset($_SESSION["Id_compte"])) {
        header("Location: index.php?action=login");
        exit();
    }
    require ('models/message/message.php');
    require_once('lib/database/Database.php');
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['search_contact'])) {
        $search_term = $_POST['search_contact'];
        $search_results = search_accounts($search_term);
    }
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_contact'])) {
        $current_user_id = $_SESSION['Id_compte']; 
        $new_contact_id = $_POST['add_contact_id']; 
        add_contact($current_user_id, $new_contact_id);
    }
    if ($_SERVER["REQUEST_METHOD"] == "POST"&& isset($_POST["send_message"]))  {
        if (isset($_POST['send_message'])) {
            send_message($_POST['message']);
        }
    }
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit_search_add'])) {
        $search_term = $_POST['search_bar_add'];
        $search_results_add = search_accounts($search_term);
    }
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_contact_groupe'])) {
        $id_groupe = $_GET['correspondant']; 
        $new_contact_id = $_POST['add_contact_id']; 
        add_contact_groupe($id_groupe, $new_contact_id);
    }
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['exit_group'])) {
        $id_groupe = $_GET['correspondant']; 
        $id_compte = $_SESSION['Id_compte']; 
        exit_group($id_groupe, $id_compte);
        header('Location: index.php?action=messagerie');
        exit();
    }
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['updateSettings'])) {
        $group_id = $_POST['groupId'];
        $new_name = null;
        if (isset($_POST['groupTitle'])&& !empty($_POST['groupTitle'])) {
            $new_name = $_POST['groupTitle'];
        }
        if (isset($_FILES['groupImage']['name'])) {
            $uploaded_file_path = your_image_upload_function($_FILES['groupImage']['name'],$_GET['correspondant']);
        }
        update_group_settings($group_id, $new_name, $uploaded_file_path);
    }
    require_once ('views/message/message.php');
}