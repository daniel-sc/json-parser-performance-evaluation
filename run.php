<?php

use Cerbero\JsonParser\JsonParser;
use GuzzleHttp\Psr7\StreamWrapper;
use GuzzleHttp\Psr7\Utils;
use JsonMachine\Items;
use JsonMachine\JsonDecoder\ExtJsonDecoder;
use JsonStreamingParser\Listener\IdleListener;
use JsonStreamingParser\Parser;

require_once __DIR__ . '/vendor/autoload.php';

$example = '[
    {
      "status": "disabled",
      "name": {
        "first": "Icie",
        "middle": "Addison",
        "last": "Hane"
      },
      "username": "Icie-Hane",
      "password": "9nQO2U_5KdIqUzl",
      "emails": [
        "Danika.Mayert-Roberts@gmail.com",
        "Murl.Witting-Denesik59@example.com"
      ],
      "phoneNumber": "510-891-2422 x129",
      "location": {
        "street": "93930 Feeney Well",
        "city": "Paucektown",
        "state": "Michigan",
        "country": "Bahamas",
        "zip": "11057-4809",
        "coordinates": {
          "latitude": 17.546,
          "longitude": 92.1562
        }
      },
      "website": "https://shallow-reinscription.biz",
      "domain": "ecstatic-breath.biz",
      "job": {
        "title": "Lead Group Architect",
        "descriptor": "Forward",
        "area": "Mobility",
        "type": "Representative",
        "company": "Satterfield LLC"
      },
      "creditCard": {
        "number": "3792-851657-43592",
        "cvv": "279",
        "issuer": "american_express"
      },
      "uuid": "5574dc14-585d-4965-af66-2e45b914e267",
      "objectId": "65ce7f69d1201c556f203588"
    },
    {
      "status": "active",
      "name": {
        "first": "Eduardo",
        "middle": "Corey",
        "last": "Lehner-Wisozk"
      },
      "username": "Eduardo-Lehner-Wisozk",
      "password": "KhhtxDY_1za98_7",
      "emails": [
        "Judy_Marks@example.com",
        "Keanu31@gmail.com"
      ],
      "phoneNumber": "304.299.3497 x0168",
      "location": {
        "street": "977 Kautzer Fall",
        "city": "Ninachester",
        "state": "Oregon",
        "country": "Kuwait",
        "zip": "62280-2503",
        "coordinates": {
          "latitude": -68.2546,
          "longitude": -54.3919
        }
      },
      "website": "https://glamorous-dud.com/",
      "domain": "trifling-wasting.biz",
      "job": {
        "title": "National Paradigm Architect",
        "descriptor": "Customer",
        "area": "Optimization",
        "type": "Developer",
        "company": "Brekke and Sons"
      },
      "creditCard": {
        "number": "6593-6225-6412-1845-5506",
        "cvv": "941",
        "issuer": "discover"
      },
      "uuid": "9f0bab61-262d-4ba2-8c01-4ef34fe38806",
      "objectId": "65ce7f69d1201c556f203589"
    },
    {
      "status": "disabled",
      "name": {
        "first": "Delfina",
        "middle": "Phoenix",
        "last": "Zboncak"
      },
      "username": "Delfina-Zboncak",
      "password": "NGz20gpzLdLMtrI",
      "emails": [
        "Flavie.Bergstrom13@gmail.com",
        "Theodore_Gottlieb30@example.com"
      ],
      "phoneNumber": "(780) 874-0168 x7902",
      "location": {
        "street": "3665 Veum Place",
        "city": "North Junebury",
        "state": "Indiana",
        "country": "Cuba",
        "zip": "30178-1252",
        "coordinates": {
          "latitude": -84.1611,
          "longitude": -74.0963
        }
      },
      "website": "https://crooked-guard.info/",
      "domain": "able-wrap.name",
      "job": {
        "title": "Corporate Program Manager",
        "descriptor": "Principal",
        "area": "Response",
        "type": "Technician",
        "company": "Rosenbaum - Douglas"
      },
      "creditCard": {
        "number": "3529-7599-9063-6430",
        "cvv": "918",
        "issuer": "jcb"
      },
      "uuid": "c2b8b2fd-1de8-40a5-96d0-b5534b83a717",
      "objectId": "65ce7f69d1201c556f20358a"
    },
    {
      "status": "disabled",
      "name": {
        "first": "Bethel",
        "middle": "Taylor",
        "last": "Koch"
      },
      "username": "Bethel-Koch",
      "password": "sV0qKo9bVdxBqzy",
      "emails": [
        "Peter_Sipes@example.com",
        "Lisette18@gmail.com"
      ],
      "phoneNumber": "813.536.6526",
      "location": {
        "street": "200 Gerard Knoll",
        "city": "Moline",
        "state": "Hawaii",
        "country": "Djibouti",
        "zip": "68874-2255",
        "coordinates": {
          "latitude": 2.5428,
          "longitude": -13.5656
        }
      },
      "website": "https://definitive-edge.net/",
      "domain": "musty-ecumenist.com",
      "job": {
        "title": "Lead Usability Officer",
        "descriptor": "Chief",
        "area": "Mobility",
        "type": "Consultant",
        "company": "Oberbrunner - Stoltenberg"
      },
      "creditCard": {
        "number": "5441-9280-0273-9637",
        "cvv": "176",
        "issuer": "mastercard"
      },
      "uuid": "e9abc051-62c8-4b12-a934-a0593538a442",
      "objectId": "65ce7f69d1201c556f20358b"
    },
    {
      "status": "active",
      "name": {
        "first": "Haskell",
        "middle": "Noah",
        "last": "Botsford"
      },
      "username": "Haskell-Botsford",
      "password": "cxFpShKRTaaj7Ce",
      "emails": [
        "Hollie70@example.com",
        "Sasha.Beatty95@gmail.com"
      ],
      "phoneNumber": "1-270-893-6916 x44176",
      "location": {
        "street": "931 Mellie Alley",
        "city": "Frisco",
        "state": "Montana",
        "country": "Bermuda",
        "zip": "42477-8653",
        "coordinates": {
          "latitude": 57.2299,
          "longitude": -167.6238
        }
      },
      "website": "https://entire-witness.info",
      "domain": "gummy-laugh.net",
      "job": {
        "title": "Central Usability Facilitator",
        "descriptor": "Future",
        "area": "Branding",
        "type": "Supervisor",
        "company": "Schimmel LLC"
      },
      "creditCard": {
        "number": "6457-6293-0144-8826-4804",
        "cvv": "716",
        "issuer": "mastercard"
      },
      "uuid": "e9f00409-ea6d-441f-bc81-9ad615398366",
      "objectId": "65ce7f69d1201c556f20358c"
    },
    {
      "status": "active",
      "name": {
        "first": "Krista",
        "middle": "James",
        "last": "Mraz"
      },
      "username": "Krista-Mraz",
      "password": "Hes7bAmhNlQCgf1",
      "emails": [
        "Arely73@gmail.com",
        "Braeden.Little85@gmail.com"
      ],
      "phoneNumber": "(748) 353-1715",
      "location": {
        "street": "484 Lueilwitz Way",
        "city": "Blickside",
        "state": "New Jersey",
        "country": "Puerto Rico",
        "zip": "38472-5110",
        "coordinates": {
          "latitude": 81.2722,
          "longitude": -47.7542
        }
      },
      "website": "https://cylindrical-schooner.biz",
      "domain": "lawful-ethics.org",
      "job": {
        "title": "Customer Quality Officer",
        "descriptor": "Legacy",
        "area": "Applications",
        "type": "Coordinator",
        "company": "Jenkins - Collier"
      },
      "creditCard": {
        "number": "3739-661083-57188",
        "cvv": "082",
        "issuer": "visa"
      },
      "uuid": "a7033cf0-b1a2-4a9c-a59e-8a1a0bbbb65f",
      "objectId": "65ce7f69d1201c556f20358d"
    },
    {
      "status": "active",
      "name": {
        "first": "Narciso",
        "middle": "Angel",
        "last": "Hoeger"
      },
      "username": "Narciso-Hoeger",
      "password": "OAfoHwCht_n8_qN",
      "emails": [
        "Dahlia35@gmail.com",
        "Lou.Bergnaum75@example.com"
      ],
      "phoneNumber": "(757) 499-0919",
      "location": {
        "street": "28770 Raquel Rest",
        "city": "Beavercreek",
        "state": "Virginia",
        "country": "Lesotho",
        "zip": "40584",
        "coordinates": {
          "latitude": 39.8513,
          "longitude": -19.3254
        }
      },
      "website": "https://well-made-inbox.info",
      "domain": "perfect-opening.info",
      "job": {
        "title": "International Metrics Executive",
        "descriptor": "Product",
        "area": "Directives",
        "type": "Supervisor",
        "company": "Hoeger and Sons"
      },
      "creditCard": {
        "number": "3589-0649-5163-1430",
        "cvv": "748",
        "issuer": "visa"
      },
      "uuid": "8a9a77d2-ef89-44ce-a4bf-66f1567f2bb1",
      "objectId": "65ce7f69d1201c556f20358e"
    },
    {
      "status": "active",
      "name": {
        "first": "Reagan",
        "middle": "Hayden",
        "last": "DAmore"
      },
      "username": "Reagan-DAmore",
      "password": "aGqVquBcV4gImtu",
      "emails": [
        "Alexys6@gmail.com",
        "Trinity87@example.com"
      ],
      "phoneNumber": "709-449-2041",
      "location": {
        "street": "689 Cathrine Field",
        "city": "Zboncakville",
        "state": "Tennessee",
        "country": "New Zealand",
        "zip": "77182",
        "coordinates": {
          "latitude": -23.1508,
          "longitude": 133.175
        }
      },
      "website": "https://good-natured-mitten.info",
      "domain": "delightful-competence.net",
      "job": {
        "title": "District Research Administrator",
        "descriptor": "Regional",
        "area": "Configuration",
        "type": "Coordinator",
        "company": "Weber - Dooley"
      },
      "creditCard": {
        "number": "4270-9892-7992-5050",
        "cvv": "526",
        "issuer": "mastercard"
      },
      "uuid": "a5c10f9b-5aa7-4d1d-9190-70d0c17b9189",
      "objectId": "65ce7f69d1201c556f20358f"
    },
    {
      "status": "disabled",
      "name": {
        "first": "Roberto",
        "middle": "Ryan",
        "last": "Simonis"
      },
      "username": "Roberto-Simonis",
      "password": "YFdiO06U5TxI6ky",
      "emails": [
        "Angelica_Ernser@gmail.com",
        "Fausto.Schinner@example.com"
      ],
      "phoneNumber": "1-991-518-3724 x361",
      "location": {
        "street": "4348 Beer Dam",
        "city": "Wildermanfurt",
        "state": "Michigan",
        "country": "Puerto Rico",
        "zip": "08781-2901",
        "coordinates": {
          "latitude": 30.6582,
          "longitude": 152.334
        }
      },
      "website": "https://embellished-quotation.info/",
      "domain": "mean-water.org",
      "job": {
        "title": "National Branding Orchestrator",
        "descriptor": "Internal",
        "area": "Metrics",
        "type": "Assistant",
        "company": "Walter - Lesch"
      },
      "creditCard": {
        "number": "3692-222234-9592",
        "cvv": "630",
        "issuer": "mastercard"
      },
      "uuid": "77588be9-87f2-4396-8e2f-12f96a30d517",
      "objectId": "65ce7f69d1201c556f203590"
    },
    {
      "status": "disabled",
      "name": {
        "first": "Scarlett",
        "middle": "James",
        "last": "Swift"
      },
      "username": "Scarlett-Swift",
      "password": "_ndkmejkYrm5O1R",
      "emails": [
        "Jodie55@gmail.com",
        "Paula_Lesch@gmail.com"
      ],
      "phoneNumber": "1-409-751-8398 x34600",
      "location": {
        "street": "54225 Benedict View",
        "city": "Ceres",
        "state": "New Hampshire",
        "country": "South Georgia and the South Sandwich Islands",
        "zip": "04093-1563",
        "coordinates": {
          "latitude": 31.4321,
          "longitude": -141.6001
        }
      },
      "website": "https://cooperative-bustle.com",
      "domain": "scornful-shield.com",
      "job": {
        "title": "Direct Usability Producer",
        "descriptor": "Principal",
        "area": "Infrastructure",
        "type": "Liaison",
        "company": "Bergstrom Group"
      },
      "creditCard": {
        "number": "3679-708147-8637",
        "cvv": "582",
        "issuer": "discover"
      },
      "uuid": "5cb87835-aef3-490c-99c0-eb8f946747d0",
      "objectId": "65ce7f69d1201c556f203591"
    },
    {
      "status": "disabled",
      "name": {
        "first": "Hassie",
        "middle": "North",
        "last": "MacGyver"
      },
      "username": "Hassie-MacGyver",
      "password": "MSF4Ld6KjUGC77h",
      "emails": [
        "Ludwig63@example.com",
        "Mohammed95@gmail.com"
      ],
      "phoneNumber": "965.877.1038 x2346",
      "location": {
        "street": "811 Yundt Crest",
        "city": "Morarton",
        "state": "Arizona",
        "country": "Faroe Islands",
        "zip": "51583",
        "coordinates": {
          "latitude": -7.192,
          "longitude": -121.7392
        }
      },
      "website": "https://limited-laborer.org",
      "domain": "sleepy-pool.info",
      "job": {
        "title": "Legacy Implementation Officer",
        "descriptor": "Lead",
        "area": "Implementation",
        "type": "Designer",
        "company": "Grimes, Thompson and Romaguera"
      },
      "creditCard": {
        "number": "3667-527633-4486",
        "cvv": "443",
        "issuer": "diners_club"
      },
      "uuid": "47011aa0-9f29-4c7e-9ed0-90f79af90011",
      "objectId": "65ce7f69d1201c556f203592"
    },
    {
      "status": "disabled",
      "name": {
        "first": "Yvonne",
        "middle": "James",
        "last": "Moen"
      },
      "username": "Yvonne-Moen",
      "password": "U3icVuNKS7TPBxy",
      "emails": [
        "Deshaun_Kuvalis@example.com",
        "Vicky.Schuppe83@gmail.com"
      ],
      "phoneNumber": "1-343-726-7974 x0467",
      "location": {
        "street": "12556 Mertz Oval",
        "city": "Carmichael",
        "state": "California",
        "country": "Rwanda",
        "zip": "94226-1925",
        "coordinates": {
          "latitude": -50.5198,
          "longitude": 75.33
        }
      },
      "website": "https://tremendous-mesenchyme.info/",
      "domain": "bleak-objective.org",
      "job": {
        "title": "Forward Interactions Orchestrator",
        "descriptor": "Central",
        "area": "Security",
        "type": "Assistant",
        "company": "Green - King"
      },
      "creditCard": {
        "number": "3549-1432-9058-1800",
        "cvv": "395",
        "issuer": "maestro"
      },
      "uuid": "3f6aaea6-1ceb-417d-abd3-68257409240e",
      "objectId": "65ce7f69d1201c556f203593"
    },
    {
      "status": "disabled",
      "name": {
        "first": "Samantha",
        "middle": "Rory",
        "last": "Zemlak"
      },
      "username": "Samantha-Zemlak",
      "password": "Ez0gd6HPV73txgp",
      "emails": [
        "Justen.Schneider83@example.com",
        "Dennis_Gleichner@example.com"
      ],
      "phoneNumber": "1-215-204-5525 x96599",
      "location": {
        "street": "31604 Rau Garden",
        "city": "West Camren",
        "state": "Missouri",
        "country": "Pitcairn Islands",
        "zip": "93735",
        "coordinates": {
          "latitude": -19.5061,
          "longitude": 80.5024
        }
      },
      "website": "https://wordy-bankbook.info",
      "domain": "tragic-chime.info",
      "job": {
        "title": "Future Accountability Officer",
        "descriptor": "Product",
        "area": "Research",
        "type": "Designer",
        "company": "Ritchie, Prosacco and Haley"
      },
      "creditCard": {
        "number": "3773-399103-79962",
        "cvv": "786",
        "issuer": "maestro"
      },
      "uuid": "82868de5-3da9-46ca-8793-dc791150035a",
      "objectId": "65ce7f69d1201c556f203594"
    },
    {
      "status": "disabled",
      "name": {
        "first": "Hosea",
        "middle": "Kyle",
        "last": "Huels"
      },
      "username": "Hosea-Huels",
      "password": "7pb4KH33t3pY1Zm",
      "emails": [
        "Caroline74@gmail.com",
        "Lindsey.Christiansen61@example.com"
      ],
      "phoneNumber": "(818) 927-6556 x69344",
      "location": {
        "street": "511 Jean Glens",
        "city": "New Marjoryshire",
        "state": "Louisiana",
        "country": "Bouvet Island",
        "zip": "24620",
        "coordinates": {
          "latitude": -77.5232,
          "longitude": -24.5061
        }
      },
      "website": "https://prickly-turban.info",
      "domain": "klutzy-hemp.name",
      "job": {
        "title": "International Optimization Director",
        "descriptor": "National",
        "area": "Applications",
        "type": "Supervisor",
        "company": "Wunsch, Carter and Larson"
      },
      "creditCard": {
        "number": "4534-3009-3320-0074",
        "cvv": "816",
        "issuer": "diners_club"
      },
      "uuid": "8f87020b-6f7f-4410-b69b-8f13df6c421a",
      "objectId": "65ce7f69d1201c556f203595"
    },
    {
      "status": "disabled",
      "name": {
        "first": "Rosalinda",
        "middle": "Avery",
        "last": "Crona"
      },
      "username": "Rosalinda-Crona",
      "password": "qdyqj3xTXKQ8nYo",
      "emails": [
        "Albertha_Koss83@example.com",
        "Ardella77@example.com"
      ],
      "phoneNumber": "1-293-654-4518 x131",
      "location": {
        "street": "6599 Kshlerin Meadow",
        "city": "Leoneton",
        "state": "New York",
        "country": "Vietnam",
        "zip": "09056",
        "coordinates": {
          "latitude": -41.0534,
          "longitude": -13.6958
        }
      },
      "website": "https://stupendous-plow.biz",
      "domain": "impossible-jelly.name",
      "job": {
        "title": "Lead Data Producer",
        "descriptor": "Direct",
        "area": "Tactics",
        "type": "Producer",
        "company": "Connelly and Sons"
      },
      "creditCard": {
        "number": "3730-255779-24851",
        "cvv": "470",
        "issuer": "mastercard"
      },
      "uuid": "56723d46-312b-43c7-a4ac-e90a8b78d3c1",
      "objectId": "65ce7f69d1201c556f203596"
    },
    {
      "status": "active",
      "name": {
        "first": "Carley",
        "middle": "Alex",
        "last": "Treutel"
      },
      "username": "Carley-Treutel",
      "password": "hehqbjHkCMuBkrt",
      "emails": [
        "Cleve_Champlin@gmail.com",
        "Orlo.Rau-Kertzmann2@example.com"
      ],
      "phoneNumber": "1-850-905-3006 x3233",
      "location": {
        "street": "1764 Pat Dale",
        "city": "Fort Golda",
        "state": "Nevada",
        "country": "Ukraine",
        "zip": "87267-9132",
        "coordinates": {
          "latitude": 80.9144,
          "longitude": -167.0435
        }
      },
      "website": "https://informal-god.name/",
      "domain": "definitive-lens.net",
      "job": {
        "title": "Global Interactions Strategist",
        "descriptor": "Principal",
        "area": "Creative",
        "type": "Producer",
        "company": "Mills, MacGyver and Rowe"
      },
      "creditCard": {
        "number": "3558-6325-6762-7476",
        "cvv": "658",
        "issuer": "discover"
      },
      "uuid": "5f7c9d26-7847-425f-97bd-d950526be353",
      "objectId": "65ce7f69d1201c556f203597"
    }
  ]';

echo "input size: " . strlen($example) . "\n";

function measure(callable $fn)
{
    gc_collect_cycles();
    $startMem = memory_get_usage();
    $start = getrusage();
    $startSec = microtime(true);
    for ($i = 0; $i < 1000; $i++) {
        $fn();
    }
    $endSec = microtime(true);
    $end = getrusage();
    $endMem = memory_get_usage();
    echo "memory peak: " . ($endMem - $startMem)/1024 . " kB\n";
    echo "clock time sec: " . ($endSec - $startSec) . "\n";
    $duration = ($end["ru_utime.tv_sec"] * 1e6 + $end["ru_utime.tv_usec"]) - ($start["ru_utime.tv_sec"] * 1e6 + $start["ru_utime.tv_usec"]);
    echo "CPU time ms: " . ($duration / 1000) . " ms\n";
}

echo "\njson_decode:\n";
measure(function () use ($example) {
    $json = json_decode($example, true);
    $result = array_map(fn($x) => ['username' => $x['username'], 'password' => $x['password']], $json);
    #echo 'result: ' . json_encode($result) . "\n";
});


echo "\nJsonParser:\n";
measure(function () use ($example) {
    $result = JsonParser::parse(Utils::streamFor($example))->pointers(['/-/username', '/-/password'])->toArray();
    //echo 'result: ' . json_encode($result) . "\n";
});

echo "\njson-machine:\n";
measure(function () use ($example) {
    $json = Items::fromStream(StreamWrapper::getResource(Utils::streamFor($example)), ['decoder' => new ExtJsonDecoder(true)]);
    $result = [];
    foreach ($json as $item) {
        $result[] = ['username' => $item['username'], 'password' => $item['password']];
    }
    //echo 'result: ' . json_encode($result) . "\n";
});

echo "\njsonstreamingparser:\n";
measure(function () use ($example) {
    $listener = new class extends IdleListener {
        public $result = [];
        private $objectLevel = 0;
        private $currentKey = null;

        public function startObject():void {
            $this->objectLevel++;
        }

        public function startArray(): void
        {
            $this->objectLevel++;
        }

        public function endArray(): void
        {
             $this->objectLevel--;
        }

        public function endObject():void {
            $this->objectLevel--;
        }
        public function key($key):void {
            $this->currentKey = $key;
        }
        public function value($value):void {
            if ($this->objectLevel === 2 && $this->currentKey === 'password') {
                $this->result[] = ['password' => $value];
            } elseif ($this->objectLevel === 2 && $this->currentKey === 'username') {
                $this->result[] = ['username' => $value];
            }
        }
    };
    $parser = new Parser(StreamWrapper::getResource(Utils::streamFor($example)), $listener);
    $parser->parse();
    //echo 'result: ' . json_encode($listener->result) . "\n";
});
