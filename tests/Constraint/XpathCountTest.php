<?php
/*
 * This file is part of phpunit-xpath-assertions.
 *
 * (c) Thomas Weinert <thomas@weinert.info>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace PHPUnit\Xpath\Constraint;

require_once __DIR__ . '/../TestCase.php';

use PHPUnit\Xpath\TestCase;

class XpathCountTest extends TestCase
{
    public function testXpathCountExpectingTrue()
    {
        $constraint = new XpathCount(1, '//child');
        $this->assertTrue(
            $constraint->evaluate($this->getXMLDocument(), '', true)
        );
    }

    public function testXpathCountWithNamespaceExpectingTrue()
    {
        $constraint = new XpathCount(2, '//d:child', ['d' => 'urn:dummy']);
        $this->assertTrue(
            $constraint->evaluate($this->getXMLDocument(), '', true)
        );
    }

    public function testXpathCountExpectingFalse()
    {
        $constraint = new XpathCount(23, '//child');
        $this->assertFalse(
            $constraint->evaluate($this->getXMLDocument(), '', true)
        );
    }

    public function testXpathCountCastToStringReturnsMessageWithCount()
    {
        $constraint = new XpathCount(1, '//child');
        $this->assertSame(
            'count matches 1',
            $constraint->toString()
        );
    }
}
