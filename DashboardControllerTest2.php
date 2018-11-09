<?php
require_once ('src/controller/DashboadController2.php');

use PHPUnit\Framework\TestCase;


class DashboardControllerTest extends TestCase{

	private $dashboard;

	protected function setUp()
        {
		$this->dashboard = new DashboardController();
		
	}

	protected function tearDown()
        {
		$this->dashboard = NULL;
	
	}

	// export_error SCENARIO
        public function test_export_error_empty()
        {
                $this->markTestSkipped();
                $this->assertEquals('',$this->dashboard->export_error('値を入力して下さい','', '',''));        
        }

        public function test_export_error_invalid_input()
        {
                $this->markTestSkipped();
                $this->assertEquals('',$this->dashboard->export_error('入力された値は無効です','abc', 'abc','abc'));
        }

        public function test_export_error_db_error()
        {
                $this->markTestSkipped();
                $this->assertEquals('',$this->dashboard->export_error('内部サーバーエラー(DB)','123', '123', '123'));
        }

        public function test_export_error_csv_error()
        {
                $this->markTestSkipped();
                $this->assertEquals('',$this->dashboard->export_error('内部サーバーエラー(Export CSV)','123', '123', '123'));
        }

        // perform_Export SCENARIO

	public function test_perform_Export_all_data()
        {
                $this->markTestSkipped();
		$expected = array(
				"msn" => "",
                "timestamp" => "",
                "gps_lat" => "Null",
                "gps_lon" => "Null",
                "gps_horacc" => "Null",
                "gps_satnum" => "Null",
                "gps_fixtime" => "Null",
                "nw_lat" => "Null",
                "nw_lon" => "Null",
                "nw_horacc" => "Null",
                "nw_module" => "",
                "mcc" => "",
                "mnc" => "",
                "rnc_id" => "",
                "cell_id" => "",
                "lac" => "",
                "ci" => "",
                "tac" => "",
                "wifi_ap" => "",
                "useragent" => "",
                "os_version" => "",
                "application" => "",
                "wifi_lat" => "Null",
                "wifi_lon" => "Null",
                "wifi_horacc" => "Null",
                "cell_lat" => "Null",
                "cell_lon" => "Null",
                "cell_horacc" => "Null",
                "resp_timestamp" => "",
                "result_code" => 200
			);
		$this->assertEquals($expected, $this->dashboard->perform_Export("09030151331", "20181022100000", "20181023100000" ));

	}

        public function test_perform_Export_with_limits()
        {
               $this->markTestSkipped();
                $expected = array(
                                "msn" => "",
                "timestamp" => "",
                "gps_lat" => "Null",
                "gps_lon" => "Null",
                "gps_horacc" => "Null",
                "gps_satnum" => "Null",
                "gps_fixtime" => "Null",
                "nw_lat" => "Null",
                "nw_lon" => "Null",
                "nw_horacc" => "Null",
                "nw_module" => "",
                "mcc" => "",
                "mnc" => "",
                "rnc_id" => "",
                "cell_id" => "",
                "lac" => "",
                "ci" => "",
                "tac" => "",
                "wifi_ap" => "",
                "useragent" => "",
                "os_version" => "",
                "application" => "",
                "wifi_lat" => "Null",
                "wifi_lon" => "Null",
                "wifi_horacc" => "Null",
                "cell_lat" => "Null",
                "cell_lon" => "Null",
                "cell_horacc" => "Null",
                "resp_timestamp" => "",
                "result_code" => 200
                        );
                /*$this->assertEquals(null, $this->dashboard->perform_Export($expected,"09030151331", "20181022100000", "20181023100000" ));*/
                 $this->assertContains('Content-Type: text/csv', xdebug_get_headers());

        }

        public function test_perform_Export_headers_only()
        {
                //$this->markTestSkipped();
                $expected = array();
                $this->assertEquals(null, $this->dashboard->perform_Export($expected, '09123456789', '20181022100000', '20191231000000' ));

        }

        // export_To_CSV SCENARIO

        public function test_export_To_CSV_empty_msn()
        {
                $this->markTestSkipped();
                $_POST['msn']    = '';
                $_POST['dstart'] = '*';
                $_POST['dend']   = '*';

                $this->assertNull($this->dashboard->export_To_CSV());
        }
	
        public function test_export_To_CSV_empty_dstart()
        {
                $this->markTestSkipped();
                $_POST['msn']    = '*';
                $_POST['dstart'] = '';
                $_POST['dend']   = '*';

                $this->assertNull($this->dashboard->export_To_CSV());
        }

        public function test_export_To_CSV_empty_dend()
        {
                $this->markTestSkipped();
                $_POST['msn']    = '*';
                $_POST['dstart'] = '*';
                $_POST['dend']   = '';

                $this->assertNull($this->dashboard->export_To_CSV());
        }

        public function test_export_To_CSV_exceed_msn()
        {
                $this->markTestSkipped();
                $_POST['msn']    = '090391535120';
                $_POST['dstart'] = '*';
                $_POST['dend']   = '*';

                $this->assertNull($this->dashboard->export_To_CSV());
        }
        
        public function test_export_To_CSV_exceed_dstart()
        {
                $this->markTestSkipped();
                $_POST['msn']    = '*';
                $_POST['dstart'] = '201809191259312';
                $_POST['dend']   = '*';

                $this->assertNull($this->dashboard->export_To_CSV());
        }

        public function test_export_To_CSV_exceed_dend()
        {
                $this->markTestSkipped();
                $_POST['msn']    = '*';
                $_POST['dstart'] = '*';
                $_POST['dend']   = '201809191300000';

                $this->assertNull($this->dashboard->export_To_CSV());
        }

        public function test_export_To_CSV_invalid_msn()
        {
                $this->markTestSkipped();
                $_POST['msn']    = '09039*';
                $_POST['dstart'] = '*';
                $_POST['dend']   = '*';

                $this->assertNull($this->dashboard->export_To_CSV());
        }
        
        public function test_export_To_CSV_invalid_dstart()
        {
                $this->markTestSkipped();
                $_POST['msn']    = '*';
                $_POST['dstart'] = '20180919abc';
                $_POST['dend']   = '*';

                $this->assertNull($this->dashboard->export_To_CSV());
        }

        public function test_export_To_CSV_invalid_dend()
        {
                $this->markTestSkipped();
                $_POST['msn']    = '*';
                $_POST['dstart'] = '*';
                $_POST['dend']   = 'abc*';

                $this->assertNull($this->dashboard->export_To_CSV());
        }

        public function test_export_To_CSV_dstart_greater_than_dend()
        {
                //$this->markTestSkipped();
                $_POST['msn']    = '*';
                $_POST['dstart'] = '20180919130000';
                $_POST['dend']   = '20180919125931';

                $this->assertNull($this->dashboard->export_To_CSV());
        }
}

?>