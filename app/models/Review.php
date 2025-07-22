<?php
class Review extends Model {
    public function get($movieId) {
        $stmt = $this->db->prepare("SELECT review FROM reviews WHERE movie_id = ?");
        $stmt->execute([$movieId]);
        return $stmt->fetchColumn();
    }

    public function save($movieId, $text) {
        $stmt = $this->db->prepare("INSERT INTO reviews (movie_id, review) VALUES (?, ?)");
        $stmt->execute([$movieId, $text]);
    }

    public function generate($movieData) {
        $prompt = "Write a short review of this movie:\n" . json_encode($movieData);
        $url = "https://generativelanguage.googleapis.com/v1beta/models/gemini-pro:generateContent?key=" . GEMINI_API_KEY;

        $body = json_encode([
            "contents" => [
                ["parts" => [["text" => $prompt]]]
            ]
        ]);

        $options = [
            'http' => [
                'method'  => 'POST',
                'header'  => "Content-Type: application/json",
                'content' => $body
            ]
        ];

        $response = file_get_contents($url, false, stream_context_create($options));
        $result = json_decode($response, true);

        return $result['candidates'][0]['content']['parts'][0]['text'] ?? 'No review available.';
    }
}
