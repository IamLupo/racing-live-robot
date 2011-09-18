<?php
class Equipment
{
	var $equipment = array();
	
	function __construct()
	{
		$this->equipment = $this->Default_Equipment();
	}
	
	function Default_Equipment()
	{
		return array(
		//	array( ID,	Name,									Upkeep,	Own,	Cost,	Speed,	Handeling	)
			array(	1,		"Scion tC",							0,		0,		4750,		2,		2	),
			array(	2,		"Honda Civic",						0,		0,		13300,		12,		9	),
			array(	3,		"Toyota Supra",						0,		0,		18050,		19,		10	),
			array(	4,		"Mini Cooper",						0,		0,		23750,		15,		20	),
			array(	20,		"Honda S2000",						0,		0,		28500,		21,		17	),
			array(	21,		"Renault Clio v6",					0,		0,		30400,		16,		21	),
			array(	22,		"Acura TL",							0,		0,		32300,		18,		20	),
			array(	5,		"Mitsubishi Lancer Evo",			0,		0,		34200,		22,		18	),
			array(	23,		"Alfa Romeo Brera",					70,		0,		38950,		19,		23	),
			array(	24,		"Factory Five GTM",					100,	0,		42750,		19,		23	),
			array(	6,		"Audi TT RS",						200,	0,		47500,		20,		25	),
			array(	26,		"Vauxhall Monaro VXR",				200,	0,		51300,		22,		24	),
			array(	27,		"Fisker Karma",						200,	0,		54150,		26,		23	),
			array(	55,		"Lotus Exige S 240",				300,	0,		57000,		27,		23	),
			array(	27,		"Audi A4 DTM",						300,	0,		58900,		28,		22	),
			array(	29,		"Noble M12",						300,	0,		60800,		25,		26	),
			array(	7,		"BMW M3",							400,	0,		64600,		26,		27	),
			array(	2051,	"Lexus IS F",						0,		0,		0,			28,		26	),
			array(	32,		"Mercedes-Benz SLK",				400,	0,		68400,		29,		25	),
			array(	31,		"Acura ZDX",						500,	0,		71250,		27,		30	),
			array(	30,		"Audi S5 Coupe",					500,	0,		75050,		31,		29	),
			array(	2050,	"Lotus Europa S",					0,		0,		0,			23,		30	),
			array(	8,		"Porsche 911",						600,	0,		80750,		35,		28	),
			array(	33,		"BMW Z8",							700,	0,		95000,		36,		34	),
			array(	9,		"Audi R8",							900,	0,		114000,		33,		40	),
			array(	2053,	"MG XPower SV",						0,		0,		0,			40,		32	),
			array(	56,		"Aston Martin V8 Vantage",			1100,	0,		142500,		37,		39	),
			array(	10,		"Mercedes-Benz CL 600",				1400,	0,		171000,		40,		41	),
			array(	2054,	"TVR Sagaris",						0,		0,		0,			42,		40	),
			array(	38,		"Maserati Quattroporte",			1600,	0,		190000,		39,		43	),
			array(	39,		"Panamera Turbo",					1800,	0,		209000,		45,		42	),
			array(	11,		"Aston Martin Vanquish",			2200,	0,		237500,		46,		45	),
			array(	2055,	"Mercedes-Benz SLK 55 AMG Black",	0,		0,		0,			47,		44	),
			array(	40,		"Opel Astra DTM",					3100,	0,		285000,		44,		52	),
			array(	2056,	"Ruf RT12",							0,		0,		0,			52,		52	),
			array(	12,		"Maserati Gran Turismo",			3600,	0,		380000,		53,		48	),
			array(	42,		"Bentley Continental GTC",			4300,	0,		408500,		48,		56	),
			array(	57,		"Rolls Royce Ghost",				4700,	0,		427500,		55,		50	),
			array(	43,		"Lamborghini Gallardo",				5000,	0,		456000,		56,		51	),
			array(	13,		"Porsche Carrera GT",				5400,	0,		475000,		50,		60	),
			array(	2057,	"Ascari KZ1",						0,		0,		0,			60,		49	),
			array(	44,		"Mercedes-Benz SLR",				5900,	0,		532000,		60,		54	),
			array(	45,		"Saleen S7",						6300,	0,		608000,		55,		63	),
			array(	61,		"Lamborghini Murcielago LP640",		7600,	0,		788500,		75,		57	),
			array(	2059,	"Lamborghini Miura",				0,		0,		0,			74,		58	),
			array(	62,		"Mercedes-Benz SLR 722 Edition",	8300,	0,		855000,		69,		68	),
			array(	15,		"Edonis V12",						8100,	0,		950000,		79,		66	),
			array(	63,		"Toyota GT-1",						11000,	0,		1092500,	71,		78	),
			array(	64,		"Ascari A10",						12300,	0,		1235000,	86,		69	),
			array(	2058,	"Pagani Zonda F",					0,		0,		0,			95,		67	),
			array(	48,		"SSC Ultimate Aero",				15300,	0,		1330000,	100,	62	),
			array(	65,		"Koenigsegg Agera",					15800,	0,		1425000,	91,		81	),
			array(	66,		"Porsche DP 962",					17100,	0,		1567500,	110,	68	),
			array(	49,		"Panoz Esperante GTR-1",			19800,	0,		1710000,	95,		87	),
			array(	67,		"Audi R10 TDI",						27000,	0,		2565000,	96,		124	),
			array(	2001,	"Mitsubishi Eclipse",				0,		0,		0,			12,		12	),
			);
	}
	
	function GetArrayID( $v_equipment_id )
	{
		$counter = count($this->equipment);
		$v_equipment_id = intval($v_equipment_id);
		
		for($i = 0; $i < $counter; $i++)
			if($this->equipment[$i][0] == $v_equipment_id)
				return $i;

		return -1;
	}
}
?>