<?php

use App\Support\Collection;
use PHPUnit\Framework\TestCase;

class CollectionTest extends TestCase
{
    /** @test */
    public function empty_instatiated_collection_returns_no_items()
    {
        $collections = new Collection;

        $this->assertEmpty($collections->get());
    }

    /** @test */
    public function count_is_correct_for_items_passed_in()
    {
        $collection = new Collection([
            'one', 'two', 'three'
        ]);

        $this->assertEquals(3, $collection->count());
    }

    /** @test */
    public function items_returned_match_items_passed_in()
    {
        $collection = new Collection([
            'one', 'two', 'three'
        ]);

        $this->assertCount(3, $collection->get());
        $this->assertEquals($collection->get()[0], 'one');
        $this->assertEquals($collection->get()[1], 'two');
        $this->assertEquals($collection->get()[2], 'three');
    }

    /** @test */
    public function collection_is_instance_of_iterator_aggregate()
    {
        $collection = new Collection;
        $this->assertInstanceOf(IteratorAggregate::class, $collection);
    }

    /** @test */
    public function collection_can_be_iterated()
    {
        $collection = new Collection([
            'one', 'two', 'three'
        ]);
        
        $items = [];

        foreach($collection as $item){
            $items[]=$item;
        }

        $this->assertCount(3, $items);
        $this->assertInstanceOf(ArrayIterator::class, $collection->getIterator());
    }

    /** @test */
    public function collection_can_be_merged_with_another_collection()
    {
        $collection1 = new Collection(['one', 'two', 'three']);
        $collection2 = new Collection(['four', 'five']);

        $collection1->merge($collection2);

        $this->assertCount(5, $collection1->get());
        $this->assertEquals(5, $collection1->count());
    }

    /** @test */
    public function can_add_to_existing_collection()
    {
        $collection = new Collection(['one', 'two', 'three']);
        $collection->add(['four']);

        $this->assertCount(4, $collection->get());
        $this->assertEquals(4, $collection->count());
    }

    /** @test */
    public function returns_json_encoded_items()
    {
        $collection = new Collection([['username'=>'cyubahiro'],['username'=>'theotime']]);

        $this->assertEquals('[{"username":"cyubahiro"},{"username":"theotime"}]', $collection->toJson());
    }

    /** @test */
    public function json_encoding_a_collection_object_returns_json()
    {
        $collection = new Collection([['username'=>'cyubahiro'],['username'=>'theotime']]);

        $encoded = json_encode($collection);

        $this->assertEquals('[{"username":"cyubahiro"},{"username":"theotime"}]', $encoded);
    }
}