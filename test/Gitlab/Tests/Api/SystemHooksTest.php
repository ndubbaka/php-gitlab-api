<?php namespace Gitlab\Tests\Api;

class SystemHooksTest extends ApiTestCase
{
    /**
     * @test
     */
    public function shouldGetAllHooks()
    {
        $expectedArray = array(
            array('id' => 1, 'url' => 'http://www.example.com'),
            array('id' => 2, 'url' => 'http://www.example.org'),
        );

        $api = $this->getApiMock();
        $api->expects($this->once())
            ->method('get')
            ->with('hooks')
            ->will($this->returnValue($expectedArray))
        ;

        $this->assertEquals($expectedArray, $api->all());
    }

    /**
     * @test
     */
    public function shouldCreateHook()
    {
        $expectedArray = array('id' => 3, 'url' => 'http://www.example.net');

        $api = $this->getApiMock();
        $api->expects($this->once())
            ->method('post')
            ->with('hooks', array('url' => 'http://www.example.net'))
            ->will($this->returnValue($expectedArray))
        ;

        $this->assertEquals($expectedArray, $api->create('http://www.example.net'));
    }

    /**
     * @test
     */
    public function shouldTestHook()
    {
        $expectedBool = true;

        $api = $this->getApiMock();
        $api->expects($this->once())
            ->method('get')
            ->with('hooks/3')
            ->will($this->returnValue($expectedBool))
        ;

        $this->assertEquals($expectedBool, $api->test(3));
    }

    /**
     * @test
     */
    public function shouldRemoveHook()
    {
        $expectedBool = true;

        $api = $this->getApiMock();
        $api->expects($this->once())
            ->method('delete')
            ->with('hooks/3')
            ->will($this->returnValue($expectedBool))
        ;

        $this->assertEquals($expectedBool, $api->remove(3));
    }

    protected function getApiClass()
    {
        return 'Gitlab\Api\SystemHooks';
    }
}
