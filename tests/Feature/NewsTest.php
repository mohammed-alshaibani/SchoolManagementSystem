<?php

// test('example', function () {
//     $response = $this->get('/');

//     $response->assertStatus(200);
// });
it('lists news', function(){
\App\Models\News::factory()->count(3)->create();
$res = $this->actingAs(\App\Models\User::factory()->create())
->get('/news');
$res->assertStatus(200);
});
