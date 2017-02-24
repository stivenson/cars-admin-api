<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{


	public function int_random($nDigits){
		$strVal = "";
		for ($i=0; $i < $nDigits; $i++) { 
			$strVal = $strVal . rand(1,9);
		}
		return intval($strVal);
	}

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

    	// Clear all 

    	DB::table('items_orders')->delete();
    	DB::table('products')->delete();
    	DB::table('orders')->delete();
    	DB::table('users')->delete();
    	DB::table('roles')->delete();

    	// Register for default

        DB::table('roles')->insert([
            'id' => 1,
            'name' => 'Administrador'
        ]);

        DB::table('roles')->insert([
            'id' => 2,
            'name' => 'Cliente'
        ]);

        DB::table('users')->insert([
        	'id' => 1,
            'name' => str_random(10),
            'email' => str_random(10).'@gmail.com',
            'password' => Hash::make('123456'),
			'roles_id' => 2,
			'cell_phone' => str_random(10), 
			'telephone' => str_random(7), 
			'cc' => str_random(12).'', 
			'address' => 'Calle '.str_random(3).' Avenida '.str_random(3), 
			'neighborhood' => 'Colombia '.str_random(2)
        ]);

        DB::table('users')->insert([
        	'id' => 2,
            'name' => str_random(10),
            'email' => str_random(10).'@gmail.com',
            'password' => Hash::make('123456'),
			'roles_id' => 2,
			'cell_phone' => str_random(10), 
			'telephone' => str_random(7), 
			'cc' => str_random(12).'', 
			'address' => 'Calle '.str_random(3).' Avenida '.str_random(3), 
			'neighborhood' => 'Colombia '.str_random(2)
        ]);

        DB::table('users')->insert([
        	'id' => 3,
            'name' => str_random(10),
            'email' => str_random(10).'@gmail.com',
            'password' => Hash::make('123456'),
			'roles_id' => 1,
			'cell_phone' => str_random(10), 
			'telephone' => str_random(7), 
			'cc' => str_random(12).'', 
			'address' => 'Calle '.str_random(3).' Avenida '.str_random(3), 
			'neighborhood' => 'Colombia '.str_random(2)
        ]);

        DB::table('products')->insert([
        	'id' => 1,
			'name' => 'produc '.str_random(4),
			'description' => 'Lorem '.str_random(8).' ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo',
			'value' => $this->int_random(5), 
			'iva' => '16',
			'available' => 1
        ]);

        DB::table('products')->insert([
        	'id' => 2,
			'name' => 'produc '.str_random(4),
			'description' => 'Lorem '.str_random(8).' ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo',
			'value' => $this->int_random(6), 
			'iva' => '0',
			'available' => 1
        ]);
        DB::table('products')->insert([
        	'id' => 3,
			'name' => 'produc '.str_random(4),
			'description' => 'Lorem '.str_random(8).' ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo',
			'value' => $this->int_random(5), 
			'iva' => '0',
			'available' => 1
        ]);

        DB::table('orders')->insert([
        	'id' => 1,
			'delivery_type' => 1,
			'status' => 1,
			'users_id' => 1
        ]);

        DB::table('items_orders')->insert([
			'products_id' => 1, 
			'amount' => $this->int_random(2), 
			'observations' => 'Lorem'. str_random(8) .' ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore', 
			'orders_id' => 1
        ]);
        DB::table('items_orders')->insert([
			'products_id' => 2, 
			'amount' => $this->int_random(2), 
			'observations' => 'Lorem'. str_random(8) .' ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore', 
			'orders_id' => 1
        ]);
        DB::table('items_orders')->insert([
			'products_id' => 3, 
			'amount' => $this->int_random(5), 
			'observations' => 'Lorem'. str_random(8) .' ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore', 
			'orders_id' => 1
        ]);
        DB::table('orders')->insert([
        	'id' => 2,
			'delivery_type' => 1,
			'status' => 2,
			'users_id' => 1
        ]);
        DB::table('items_orders')->insert([
			'products_id' => 2, 
			'amount' => $this->int_random(5), 
			'observations' => 'Lorem'. str_random(8) .' ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore', 
			'orders_id' => 2
        ]);
        DB::table('items_orders')->insert([
			'products_id' => 3, 
			'amount' => $this->int_random(5), 
			'observations' => 'Lorem'. str_random(8) .' ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore', 
			'orders_id' => 2
        ]);
        DB::table('orders')->insert([
        	'id' => 3,
			'delivery_type' => 2,
			'status' => 3,
			'users_id' => 2
        ]);
        DB::table('items_orders')->insert([
			'products_id' => 1, 
			'amount' => $this->int_random(5), 
			'observations' => 'Lorem'. str_random(8) .' ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore', 
			'orders_id' => 3
        ]);
        DB::table('orders')->insert([
        	'id' => 4,
			'delivery_type' => 1,
			'status' => 4,
			'users_id' => 2
        ]);
        DB::table('items_orders')->insert([
			'products_id' => 3, 
			'amount' => $this->int_random(5), 
			'observations' => 'Lorem'. str_random(8) .' ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore', 
			'orders_id' => 4
        ]);

    }
}
