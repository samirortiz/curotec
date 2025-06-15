<?php

test('should auth test user', function () {
    $data = [
            'email' => 'test@example.com',
            'password' => 'test'
    ];
    $this->postJson(route('login'), $data)->assertStatus(204);
});
