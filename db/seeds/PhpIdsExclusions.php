<?php

use Phinx\Seed\AbstractSeed;

class PostsSeeder extends AbstractSeed
{
    public function run()
    {
        $data = [
            [
                'configuration_value'    => ''
            ]
        ];

        $posts = $this->table('configuration');
        $posts->insert($data)
              ->save();
    }
}

