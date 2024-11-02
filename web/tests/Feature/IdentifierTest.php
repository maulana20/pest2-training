<?php

it("service with identifier", function() {
    $this->get("/api/service/ztna/show")
        ->assertStatus(200)
        ->assertSee("Zero Trust Network Access");
});

it("service without identifier", function() {
    $this->get("/api/service/kasm/show")
        ->assertStatus(200)
        ->assertSee("Streaming Container");
});

it("service exclude identifier", function() {
    $this->get("/api/service/xxx/show")
        ->assertStatus(500);
});
