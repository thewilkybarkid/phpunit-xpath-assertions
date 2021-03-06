<?php
/*
 * This file is part of phpunit-xpath-assertions.
 *
 * (c) Thomas Weinert <thomas@weinert.info>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace PHPUnit\Xpath;

require_once __DIR__ . '/TestCase.php';

class ConstraintTest extends TestCase
{
    use Constraint;

    public function testAssertXpathMatchSuccess()
    {
        self::assertThat(
            $this->getXMLDocument(),
            self::matchesXpathExpression('//child')
        );
    }

    public function testAssertXpathCountSuccess()
    {
        self::assertThat(
            $this->getXMLDocument(),
            self::matchesXpathResultCount(1, '//child')
        );
    }

    public function testAssertXpathEqualsSuccess()
    {
        $expected = $this->getXMLDocument()->documentElement->firstChild;
        self::assertThat(
            $this->getXMLDocument(),
            self::equalToXpathResult($expected, '//child')
        );
    }

    public function testAssertXpathEqualsWithNamespaceSuccess()
    {
        $expected = $this->getXMLDocument()->documentElement->childNodes;
        self::assertThat(
            $this->getXMLDocument(),
            self::equalToXpathResult($expected, '//child|//x:child', ['x' => 'urn:dummy'])
        );
    }

    public function testAssertXpathEqualsWithStringSuccess()
    {
        self::assertThat(
            $this->getXMLDocument(),
            self::equalToXpathResult('One', 'string(//child)')
        );
    }

    public function testAssertXpathEqualsWithTrueSuccess()
    {
        self::assertThat(
            $this->getXMLDocument(),
            self::equalToXpathResult(true, 'count(//child) > 0')
        );
    }

    public function testAssertXpathEqualsWithFalseSuccess()
    {
        self::assertThat(
            $this->getXMLDocument(),
            self::equalToXpathResult(false, 'count(//child) > 42')
        );
    }

    public function testAssertXpathEqualsWithTrueFailure()
    {
        self::assertThat(
            $this->getXMLDocument(),
            self::logicalNot(
                self::equalToXpathResult(true, 'count(//child) > 42')
            )
        );
    }
}
