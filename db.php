<?php
function opendb(){
    $link = mysqli_connect("localhost","root","") or die("Connection failure" . mysqli_error($link));
    mysqli_select_db($link,"hf");
    mysqli_query($link, "set character_set_results='utf-8'");
    return $link;
}
#inicializalja az adatbazist, ha meg nem letezik.
function init_db(){
    $link = mysqli_connect("localhost","root","") or die("Connection failure" . mysqli_error($link));
    mysqli_select_db($link,"hf");


    $user = "CREATE TABLE if not exists user(
        id int primary key auto_increment,
        nev varchar(100),
        email varchar(100) unique,
        jelszo varchar(100),
        steamid varchar(40) unique,
        discordid varchar(40) unique,
        elo int DEFAULT 1500
    );";
    $merkozes = "CREATE TABLE if not exists merkozes(
        id int primary key auto_increment,
        player_1_id int,
        player_1_points int,
        player_1_list varchar(200),
        player_1_confirmed boolean default false,
        FOREIGN KEY (player_1_id) REFERENCES user(id),
        player_2_id int,
        player_2_points int,
        player_2_list varchar(200),
        player_2_confirmed boolean default false,
        FOREIGN KEY (player_2_id) REFERENCES user(id),
        elo_change int
        );";
    
    $insert1 = "INSERT INTO user(nev,email,jelszo,elo) VALUES('Jozsi','jozsi@gmail.hu','7217359295a9ae727cb667220d713adc',1500);"; // AAAAaaaa2
    $insert2 = "INSERT INTO user(nev,email,jelszo,elo) VALUES('Jancsi','jancsi@gmail.hu','24a5a37e074d43f54d3d6e033d86886e',1500);"; // juliska
    mysqli_query($link, $user);
    mysqli_query($link, $merkozes);
    mysqli_query($link, $insert1);
    mysqli_query($link, $insert2);
    mysqli_close($link);

}
?>