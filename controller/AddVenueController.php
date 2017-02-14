<?php
namespace Controller;

class AddVenueController extends PageController
{
    public function process()
    {
        try {



            $request = $this->getRequest();
            $name = $request->getProperty('venue_name');
            $submitted = $request->getProperty('submitted');

echo "<pre>"; print_r($request->addFeedback('Выберите имя заведения'));

            if (is_null($submitted)) {




                $request->addFeedback('Выберите имя заведения');



                $this->forward('templates/add_venue.php');
            }




        } catch(\Exception $e) {
            echo "here2";
        }
    }
}