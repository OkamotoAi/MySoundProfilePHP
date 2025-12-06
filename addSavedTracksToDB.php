<?php
require __DIR__ . '/vendor/autoload.php';
require 'class.php';

$api = new SpotifyWebAPI\SpotifyWebAPI();
$api->setAccessToken($_GET['accessToken']);

$conn = db_conn();

$tracks = $api->getMySavedTracks(['limit' => 50,
  'offset' => 0,
]);

foreach ($tracks->items as $track) {
  $track = $track->track;
  $features = $api->getAudioFeatures($track->id);

  $sql = "INSERT INTO music VALUES (";
  $sql .= "'" . cnv_sqlstr($track->id) . "',";
  $sql .= "'" . cnv_sqlstr($track->name) . "',";
  $sql .=  "'" . cnv_sqlstr($track->artists[0]->name) . "',";
  $sql .=  "'" . cnv_sqlstr($track->popularity) . "',";
  $sql .=  "'" . cnv_sqlstr($features->danceability) . "',";
  $sql .=  "'" . cnv_sqlstr($features->energy) . "',";
  $sql .=  "'" . cnv_sqlstr($features->key) . "',";
  $sql .=  "'" . cnv_sqlstr($features->loudness) . "',";
  $sql .=  "'" . cnv_sqlstr($features->mode) . "',";
  $sql .=  "'" . cnv_sqlstr($features->speechiness) . "',";
  $sql .=  "'" . cnv_sqlstr($features->acousticness) . "',";
  $sql .=  "'" . cnv_sqlstr($features->instrumentalness) . "',";
  $sql .=  "'" . cnv_sqlstr($features->liveness) . "',";
  $sql .=  "'" . cnv_sqlstr($features->valence) . "',";
  $sql .=  "'" . cnv_sqlstr($features->tempo) . "',";
  $sql .=  "'" . cnv_sqlstr($features->time_signature) . "'";
  $sql .= ")";

  $res = db_query($sql, $conn);
}

header('Location: index.php');
die();
?>