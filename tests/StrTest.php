<?php declare(strict_types=1);

use Antares\Support\Str;
use PHPUnit\Framework\TestCase;

final class StrTest extends TestCase
{
    private $list = ['Apple', 'Avocado', 'Cherry', 'Banana', 'Grape', 'Mango'];

    public function testStr_ascii_method()
    {
        $this->assertEquals('aaeeiioouu', Str::ascii('äãèëíïõöûü'));
    }

    public function testStr_endsWith_method()
    {
        $this->assertFalse(Str::endsWith('/full/path/to', '/'));
        $this->assertTrue(Str::endsWith('/full/path/to', 'to'));
    }

    public function testStr_finish_method()
    {
        $this->assertEquals('/full/path/to/', Str::finish('/full/path/to', '/'));
        $this->assertEquals('/full/path/to/', Str::finish('/full/path/to/', '/'));
    }

    public function testStr_icIn_method()
    {
        $this->assertFalse(Str::icIn('orange', ...$this->list));
        $this->assertTrue(Str::icIn('Grape', ...$this->list));
        $this->assertTrue(Str::icIn('AVOCADO', ...$this->list));
    }

    public function testStr_in_method()
    {
        $this->assertFalse(Str::in(true, 'apple', ...$this->list));
        $this->assertTrue(Str::in(true, 'Mango', ...$this->list));
        $this->assertTrue(Str::in(false, 'banana', ...$this->list));
    }

    public function testStr_isAscii_method()
    {
        $this->assertFalse(Str::isAscii('äãèëíïõöûü'));
        $this->assertTrue(Str::isAscii('aaeeiioouu'));
    }

    public function testStr_join_method()
    {
        $this->assertEquals(implode('|', $this->list), Str::join('|', ...$this->list));
        $this->assertEquals('apple|banana|grape|orange', Str::join('|', 'apple', 'banana', '', 'grape', null, 'orange'));
    }

    public function testStr_length_method()
    {
        $this->assertEquals(25, Str::length('orange, äãèëíïõöûü, juice'));
        $this->assertEquals(25, Str::length('orange, aaeeiioouu, juice'));
    }

    public function testStr_lower_method()
    {
        $this->assertEquals('orange, äãèëíïõöûü, juice', Str::lower('Orange, ÄãÈëÍïÕöÛü, Juice'));
        $this->assertEquals('orange, aaeeiioouu, juice', Str::lower(Str::ascii('Orange, ÄãÈëÍïÕöÛü, Juice')));
    }

    public function testStr_quoted_method()
    {
        $this->assertEquals("'Orange, ÄãÈëÍïÕöÛü, Juice'", Str::quoted('Orange, ÄãÈëÍïÕöÛü, Juice'));
        $this->assertEquals("'Orange, AaEeIiOoUu, Juice'", Str::quoted('Orange, AaEeIiOoUu, Juice'));
        $this->assertEquals("'Orange, ÄãÈëÍïÕöÛü, Juice'", Str::quoted("'Orange, ÄãÈëÍïÕöÛü, Juice"));
        $this->assertEquals("'Orange, ÄãÈëÍïÕöÛü, Juice'", Str::quoted("'Orange, ÄãÈëÍïÕöÛü, Juice'"));
        $this->assertEquals("''Orange, ÄãÈëÍïÕöÛü, Juice''", Str::quoted("'Orange, ÄãÈëÍïÕöÛü, Juice'", true));
    }

    public function testStr_quoted2_method()
    {
        $this->assertEquals('"Orange, ÄãÈëÍïÕöÛü, Juice"', Str::quoted2('Orange, ÄãÈëÍïÕöÛü, Juice'));
        $this->assertEquals('"Orange, AaEeIiOoUu, Juice"', Str::quoted2('Orange, AaEeIiOoUu, Juice'));
        $this->assertEquals('"Orange, ÄãÈëÍïÕöÛü, Juice"', Str::quoted2('"Orange, ÄãÈëÍïÕöÛü, Juice'));
        $this->assertEquals('"Orange, ÄãÈëÍïÕöÛü, Juice"', Str::quoted2('"Orange, ÄãÈëÍïÕöÛü, Juice"'));
        $this->assertEquals('""Orange, ÄãÈëÍïÕöÛü, Juice""', Str::quoted2('"Orange, ÄãÈëÍïÕöÛü, Juice"', true));
    }

    public function testStr_random_method()
    {
        $this->assertEquals(16, Str::length(Str::random()));
        $this->assertEquals(32, Str::length(Str::random(32)));
    }

    public function testStr_scIn_method()
    {
        $this->assertFalse(Str::scIn('cherry', ...$this->list));
        $this->assertTrue(Str::scIn('Cherry', ...$this->list));
    }

    public function testStr_start_method()
    {
        $this->assertEquals('/full/path/to', Str::start('full/path/to', '/'));
        $this->assertEquals('/full/path/to', Str::start('/full/path/to', '/'));
    }

    public function testStr_startsWith_method()
    {
        $this->assertFalse(Str::startsWith('/full/path/to', 'full'));
        $this->assertTrue(Str::startsWith('/full/path/to', '/full'));
    }

    public function testStr_substr_method()
    {
        $this->assertEquals('Orange', Str::substr('Orange, ÄãÈëÍïÕöÛü, Juice', 0, 6));
        $this->assertEquals('ÄãÈëÍïÕöÛü', Str::substr('Orange, ÄãÈëÍïÕöÛü, Juice', 8, 10));
        $this->assertEquals('Juice', Str::substr('Orange, ÄãÈëÍïÕöÛü, Juice', 20));
        $this->assertEquals('Juice', Str::substr('Orange, ÄãÈëÍïÕöÛü, Juice', 20, 10));
    }

    public function testStr_ucfirst_method()
    {
        $this->assertEquals('Orange', Str::ucfirst('orange'));
        $this->assertEquals('Äãèëíïõöûü', Str::ucfirst('äãèëíïõöûü'));
    }

    public function testStr_upper_method()
    {
        $this->assertEquals('ORANGE, ÄÃÈËÍÏÕÖÛÜ, JUICE', Str::upper('Orange, ÄãÈëÍïÕöÛü, Juice'));
        $this->assertEquals('ORANGE, AAEEIIOOUU, JUICE', Str::upper(Str::ascii('Orange, ÄãÈëÍïÕöÛü, Juice')));
    }

    public function testStr_wrap_method()
    {
        $this->assertEquals('/äãèëíïõöûü/', Str::wrap('äãèëíïõöûü', '/'));
        $this->assertEquals('::orange::', Str::wrap('orange', '::'));
        $this->assertEquals('::orange::', Str::wrap('::orange', '::'));
        $this->assertEquals('::::orange::', Str::wrap('::orange', '::', true));
        $this->assertEquals('::orange::', Str::wrap('orange::', '::'));
        $this->assertEquals('::orange::', Str::wrap('::orange::', '::'));
        $this->assertEquals('::::orange::::', Str::wrap('::orange::', '::', true));
    }
}
