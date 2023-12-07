<?php

require_once('db_connect.php');
class Post
{
  function findByUserId($user_id) {
    global $conn;
    $data = [];
    $sql = "SELECT * FROM posts WHERE user_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    while ($row = $result->fetch_assoc()) {
      $data[] = $row;
    }
    $stmt->close();
    return $data;
  }

  function findById($id) {
    global $conn;
    $sql = "SELECT * FROM posts WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result()->fetch_assoc();
    $stmt->close();
    return $result;
  }

  function insert($data) {
    global $conn;
    if (empty($data['content'])) {
      return false;
    }
    $sql = "INSERT INTO posts (user_id, content) VALUES (?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("is", $data['user_id'], $data['content']);
    $result = $stmt->execute();
    $stmt->close();
    return $result;
  }

  function update($data) {
    global $conn;
    if (empty($data['content'])) {
      return false;
    }
    $sql = "UPDATE posts SET content = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("si", $data['content'], $data['id']);
    $result = $stmt->execute();
    $stmt->close();
    return $result;
  }

  function delete($id) {
    global $conn;
    $sql = "DELETE FROM posts WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $result = $stmt->execute();
    $stmt->close();
    return $result;
  }
}
