<?php

/* Proxy osztaly a szentiras.hu biblia lekerdezesekhez
 * A Firefox OS -bol valo hasznalat miatt van ra szukseg
 * @author: http://www.dobrenteiistvan.hu
 * */
class BibleProxy 
{
	private $task;
	private $link;
	
	public function __construct($input)
	{
		if (isset($input['task']) && isset($input['link']) && $input['task'] != 'random')
		{
			$this->task = $input['task'];
			$this->link = $input['link'];
			$this->doQuery();	
			
		}
		elseif(isset($input['task']) && $input['task'] == 'random' && isset($input['link']))
		{
			$code = $this->getRandomPieceCode($input['link']);
			$this->task = 'idezet';
			$this->link = $code;
			$this->doQuery();
		}
		else
		{
			$this->error();
		}
	}
	
	protected function doQuery()
	{
		$response = "";
		$json = file_get_contents('http://szentiras.hu/API/?feladat=' . $this->task . '&hivatkozas=' . $this->link);
		$response .= "jsoncallback(" . $json . ")";
		echo $response;
		exit;
	}
	
	protected function getRandomPieceCode($type)
	{
		$chapters = $this->getChapters();
		$chapterO = rand(0, 45);
		$chapterU = rand(46, count($chapters)-1);
		$to = $chapters[$chapterU]['length'];
		$back  = $chapters[$chapterU]['id'];
		if($type == 'otest')
		{
			$back = $chapters[$chapterO]['id'];
			$to = $chapters[$chapterO]['length'];
		}
		
		$number = rand(1, $to);
		
		return $back . $number;
	}
	
	protected function error()
	{
		echo "Hiba!";
	}
	
	private function getChapters()
	{
		$chapters = array();
		
		$chapters[] = array(
							"name" => "Teremtés könyve",
							"id" => "Ter",
							"length" => "50"
		);
		
		$chapters[] = array(
							"name" => "Kivonulás könyve",
							"id" => "Kiv",
							"length" => "40"
		);
		
		$chapters[] = array(
							"name" => "Leviták könyve",
							"id" => "Lev",
							"length" => "27"
		);
		
		$chapters[] = array(
							"name" => "Számok könyve",
							"id" => "Szám",
							"length" => "36"
		);
		
		$chapters[] = array(
							"name" => "Második törvénykönyv",
							"id" => "MTörv",
							"length" => "34"
		);
		
		$chapters[] = array(
							"name" => "Józsue könyve",
							"id" => "Józs",
							"length" => "24"
		);
		
		$chapters[] = array(
							"name" => "Bírák könyve",
							"id" => "Bír",
							"length" => "21"
		);
		
		$chapters[] = array(
							"name" => "Rut könyve",
							"id" => "Rut",
							"length" => "4"
		);
		
		$chapters[] = array(
							"name" => "Sámuel I. könyve",
							"id" => "1Sám",
							"to" => "31"
		);
		
		$chapters[] = array(
							"name" => "Sámuel II. könyve",
							"id" => "2Sám",
							"length" => "24"
		);
		
		$chapters[] = array(
							"name" => "Királyok I. könyve",
							"id" => "1Kir",
							"length" => "22"
		);
		
		$chapters[] = array(
							"name" => "Királyok II. könyve",
							"id" => "2Kir",
							"length" => "25"
		);
		
		$chapters[] = array(
							"name" => "Krónikák I. könyve",
							"id" => "1Krón",
							"length" => "29"
		);
		
		$chapters[] = array(
							"name" => "Krónikák II. könyve",
							"id" => "2Krón",
							"length" => "36"
		);
		
		$chapters[] = array(
							"name" => "Ezdrás könyve",
							"id" => "Ezd",
							"length" => "10"
		);
		
		$chapters[] = array(
							"name" => "Nehemiás könyve",
							"id" => "Neh",
							"length" => "13"
		);
		
		$chapters[] = array(
							"name" => "Tóbiás könyve",
							"id" => "Tób",
							"length" => "14"
		);
		
		
		$chapters[] = array(
							"name" => "Judit könyve",
							"id" => "Jud",
							"length" => "16"
		);
		
		$chapters[] = array(
							"name" => "Eszter könyve",
							"id" => "Esz",
							"length" => "10"
		);
		
		$chapters[] = array(
							"name" => "Jób könyve",
							"id" => "Jób",
							"length" => "42"
		);
		
		$chapters[] = array(
							"name" => "Zsoltárok könyve",
							"id" => "Zsolt",
							"length" => "150"
		);
		
		$chapters[] = array(
							"name" => "Példabeszédek könyve",
							"id" => "Péld",
							"length" => "31"
		);
		
		$chapters[] = array(
							"name" => "Prédikátor könyve",
							"id" => "Préd",
							"length" => "12"
		);
		
		$chapters[] = array(
							"name" => "Énekek éneke",
							"id" => "Én",
							"length" => "8"
		);
		
		$chapters[] = array(
							"name" => "Bölcsesség könyve",
							"id" => "Bölcs",
							"length" => "19"
		);
		
		$chapters[] = array(
							"name" => "Sirák fia könyve",
							"id" => "Sir",
							"length" => "51"
		);
		
		$chapters[] = array(
							"name" => "Izajás könyve",
							"id" => "Iz",
							"length" => "66"
		);
		
		$chapters[] = array(
							"name" => "Jeremiás könyve",
							"id" => "Jer",
							"length" => "52"
		);
		
		$chapters[] = array(
							"name" => "Siralmak könyve",
							"id" => "Siral",
							"length" => "5"
		);
		
		$chapters[] = array(
							"name" => "Báruk könyve",
							"id" => "Bár",
							"length" => "6"
		);

		$chapters[] = array(
							"name" => "Ezekiel könyve",
							"id" => "Ez",
							"length" => "48"
		);
		
		$chapters[] = array(
							"name" => "Dániel könyve",
							"id" => "Dán",
							"length" => "14"
		);
		
		$chapters[] = array(
							"name" => "Ozeás könyve",
							"id" => "Oz",
							"length" => "14"
		);
		
		$chapters[] = array(
							"name" => "Joel könyve",
							"id" => "Jo",
							"length" => "4"
		);
		
		$chapters[] = array(
							"name" => "Ámosz könyve",
							"id" => "Ám",
							"length" => "9"
		);
		
		$chapters[] = array(
							"name" => "Abdiás könyve",
							"id" => "Abd",
							"length" => "1"
		);
		
		$chapters[] = array(
							"name" => "Jónás könyve",
							"id" => "Jón",
							"length" => "4"
		);
		
		$chapters[] = array(
							"name" => "Mikeás könyve",
							"id" => "Mik",
							"length" => "7"
		);
		
		$chapters[] = array(
							"name" => "Náhum könyve",
							"id" => "Náh",
							"length" => "3"
		);
		
		$chapters[] = array(
							"name" => "Habakuk könyve",
							"id" => "Hab",
							"length" => "3"
		);
		
		$chapters[] = array(
							"name" => "Szofoniás könyve",
							"id" => "Szof",
							"length" => "3"
		);
		
		$chapters[] = array(
							"name" => "Aggeus könyve",
							"id" => "Ag",
							"length" => "2"
		);
		
		$chapters[] = array(
							"name" => "Zakariás könyve",
							"id" => "Zak",
							"length" => "14"
		);
		
		$chapters[] = array(
							"name" => "Malakiás könyve",
							"id" => "Mal",
							"length" => "3"
		);
		
		$chapters[] = array(
							"name" => "Makkabeusok I. könyve",
							"id" => "1Mak",
							"length" => "16"
		);

		$chapters[] = array(
							"name" => "Makkabeusok II. könyve",
							"id" => "2Mak",
							"length" => "15"
		);
		
		$chapters[] = array(
							"name" => "Máté evangéliuma",
							"id" => "Mt",
							"length" => "28"
		);
		
		$chapters[] = array(
							"name" => "Márk evangéliuma",
							"id" => "Mk",
							"length" => "16"
		);
		
		$chapters[] = array(
							"name" => "Lukács evangéliuma",
							"id" => "Lk",
							"length" => "24"
		);
		
		$chapters[] = array(
							"name" => "János evangéliuma",
							"id" => "Jn",
							"length" => "21"
		);
		
		$chapters[] = array(
							"name" => "Apostolok cselekedetei",
							"id" => "ApCsel",
							"length" => "28"
		);
		
		$chapters[] = array(
							"name" => "Rómaiaknak írt levél",
							"id" => "Róm",
							"length" => "16"
		);
		
		$chapters[] = array(
							"name" => "Korintusiaknak írt I. levél",
							"id" => "1Kor",
							"length" => "16"
		);
		
		$chapters[] = array(
							"name" => "Korintusiaknak írt II. levél",
							"id" => "2Kor",
							"length" => "13"
		);
		
		$chapters[] = array(
							"name" => "Galatáknak írt levél",
							"id" => "Gal",
							"length" => "6"
		);
		
		$chapters[] = array(
							"name" => "Efezusiaknak írt levél",
							"id" => "Ef",
							"length" => "6"
		);
		
		$chapters[] = array(
							"name" => "Filippieknek írt levél",
							"id" => "Fil",
							"length" => "4"
		);
		
		$chapters[] = array(
							"name" => "Kolosszeieknek írt levél",
							"id" => "Kol",
							"length" => "4"
		);
		
		$chapters[] = array(
							"name" => "Tesszalonikaiaknak írt I. levél",
							"id" => "1Tessz",
							"length" => "5"
		);
		
		$chapters[] = array(
							"name" => "Tesszalonikaiaknak írt II. levél",
							"id" => "2Tessz",
							"length" => "3"
		);
		
		$chapters[] = array(
							"name" => "Timóteusnak írt I. levél",
							"id" => "1Tim",
							"length" => "6"
		);
		
		$chapters[] = array(
							"name" => "Timóteusnak írt II. levél",
							"id" => "2Tim",
							"length" => "4"
		);
		
		$chapters[] = array(
							"name" => "Titusznak írt levél",
							"id" => "Tit",
							"length" => "3"
		);
		
		$chapters[] = array(
							"name" => "Filemonnak írt levél",
							"id" => "Filem",
							"length" => "1"
		);
		
		$chapters[] = array(
							"name" => "Zsidóknak írt levél",
							"id" => "Zsid",
							"length" => "13"
		);
		
		$chapters[] = array(
							"name" => "Jakab levele",
							"id" => "Jak",
							"length" => "5"
		);
		
		$chapters[] = array(
							"name" => "Péter I. levele",
							"id" => "1Pt",
							"length" => "5"
		);
		
		$chapters[] = array(
							"name" => "Péter II. levele",
							"id" => "2Pt",
							"length" => "3"
		);
		
		$chapters[] = array(
							"name" => "János I. levele",
							"id" => "1Jn",
							"length" => "5"
		);
		
		$chapters[] = array(
							"name" => "János II. levele",
							"id" => "2Jn",
							"length" => "1"
		);
		
		$chapters[] = array(
							"name" => "János III. levele",
							"id" => "3Jn",
							"length" => "1"
		);
		
		$chapters[] = array(
							"name" => "Júdás levele",
							"id" => "Júd",
							"length" => "1"
		);
		
		$chapters[] = array(
							"name" => "Jelenések könyve",
							"id" => "Jel",
							"length" => "22"
		);
		
		return $chapters;
	}
}
$api = new BibleProxy($_GET);
?>