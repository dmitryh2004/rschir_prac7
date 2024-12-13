<?php 
require_once "application/core/controller.php";
require_once "application/models/entry.php";
require_once "application/models/service.php";
require_once "application/views/fixture_view.php";

class FixtureController extends Controller {
    function __construct() {
        $this->FIXTURE_COUNT = 75;
        $this->entries = new Entry();
        $this->services = new Service();
        $this->view = new FixtureView("fixtures/stats");
        $this->message = "";
    }

    public function action_index() {
        $action = (isset($_GET["action"]) ? $_GET["action"] : null);
        switch ($action) {
            case "fixtures_generate":
                $this->fixtures_generate();
                break;
            case "fixtures_stats":
            default:
                $this->action_view();
        }
    }
    
    public function action_view() {
        $fixtures = $this->entries->get_all(true);

        $data = ["fixtures" => $fixtures];
        $this->view->generate(null, $data);
    }

    public function fixtures_generate() {
        global $language;
        $this->entries->delete_all();

        $services = $this->services->get_all();
        $service_ids = [];

        if ($services) {
            foreach($services as $service) {
                if (!in_array($service["ID"], $service_ids)) {
                    $service_ids[] = $service["ID"];
                }
            }
        
            $faker = Faker\Factory::create();
        
            $fixtures = [];

            for ($i = 0; $i < $this->FIXTURE_COUNT; $i++) {
                $fixture = [
                    $faker->name(),
                    $faker->randomElement($service_ids),
                    $faker->numberBetween(1, 5),
                    $faker->optional($weight = 0.25)->realText($faker->numberBetween(10, 60)),
                ];
                $fixtures[] = $fixture;
            }

            $result = $this->entries->fill($fixtures);
            if ($result[0] == false) {
                $this->message = "Ошибка при создании фикстур. " . $result[1];
            }
            else {
                $this->message = $i . htmlspecialchars(getLocalizedText("fixtures-generated", $language));
            }
        }
        else {
            $this->message = "No services in database - unable to create fixtures.";
        }

        $this->view->generate("fixtures/generate", null, $this->message);
    }
}
?>