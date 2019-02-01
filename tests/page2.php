<?php
$tab = [
    'xyz' => "test",
    'name' => 'Huge-coders',
    'events' => [[
        "name" => "new Event",
        "created_at" => new \DateTime()
    ]]
];

extract($tab);

echo $name;