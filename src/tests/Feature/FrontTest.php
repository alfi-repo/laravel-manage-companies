<?php

it('can change language to bahasa indonesia (id)', function () {
    $this->get(route('front.index', ['lang' => 'id']));
    Session::shouldReceive('get')->with('locale')->andReturn('id');
});

it('can change language to english (en)', function () {
    $this->get(route('front.index', ['lang' => 'en']));
    Session::shouldReceive('get')->with('locale')->andReturn('en');
});

it('can not change language to russia (ru) and fallback to english (en)', function () {
    $this->get(route('front.index', ['lang' => 'ru']));
    Session::shouldReceive('get')->with('locale')->andReturn('en');
});
