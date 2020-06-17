<?php

class SelectExample {
	public function getHelpTopics($conn, $limit = 1000, $offset = 0) {
		$query = mysqli_query($conn, "SELECT * FROM help_topic LIMIT {$limit} OFFSET {$offset}");
		return $query;
	}
	
	public function getHelpTopicsCount($conn) {
		$query = mysqli_query($conn, "SELECT COUNT(*) AS count FROM help_topic");
		return mysqli_fetch_assoc($query)["count"];
	}
}