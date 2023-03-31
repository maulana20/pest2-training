<?php

it('partition', function () {
    $collection = collect([1,2,3,4,5,6]);
    $result = $collection->partition(function ($number) {
        return $number % 2 === 0;
    });
    $this->assertEqualsCanonicalizing(
        collect([
            collect([2,4,6]),
            collect([1,3,5])
        ]), $result);
});
    
it('concat', function () {
    $collection = collect([1,2,3]);
    $result = $collection->concat([4,5,6]);
    $this->assertEquals(collect([1,2,3,4,5,6]), $result);
});

it('contains', function () {
    $collection = collect([1,2,3,4,5,6]);
    $result = $collection->contains(function ($number) {
        return $number === 5;
    });
    $this->assertTrue($result);
});

it('diff', function () {
    $collection = collect([1,2,3,4,5,6]);
    $result = $collection->diff([2,4,6]);
    $this->assertEqualsCanonicalizing(collect([1,3,5]), $result);
});
