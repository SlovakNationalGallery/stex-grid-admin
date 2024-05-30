<?php

namespace Database\Seeders;

use App\Models\Item;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $item_ids = [
            "SVK:SNG.UP-I_12-a",
            "SVK:SNG.UP-T_601",
            "SVK:SNG.UP-F_1258",
            "SVK:SNG.UP-I_30",
            "SVK:SNG.UP-F_1225",
            "SVK:SNG.UP-I_72",
            "SVK:SNG.UP-T_73",
            "SVK:SNG.UP-T_74",
            "SVK:SNG.UP-T_76",
            "SVK:SNG.UP-T_77",
            "SVK:SNG.UP-F_1246",
            "SVK:SNG.UP-F_1181",
            "SVK:SNG.UP-F_126",
            "SVK:SNG.UP-DK_3812",
            "SVK:SNG.UP-DK_3813",
            "SVK:SNG.UP-DK_3814",
            "SVK:SNG.UPS-S_5-1-8",
            "SVK:SNG.UP-P_3072",
            "SVK:SNG.UP-DK_628",
            "SVK:SNG.UP-DK_960",
            "SVK:SNG.UP-F_988-1-24",
            "SVK:SNG.UP-P_3050",
            "SVK:SNG.UP-T_438",
            "SVK:SNG.UP-DK_1362",
            "SVK:SNG.UP-DK_75",
            "SVK:SNG.UP-DK_548",
            "SVK:SNG.UP-T_81",
            "SVK:SNG.MK_195",
            "SVK:SNG.UP-DK_5421",
            "SVK:SNG.UP-DK_5456",
            "SVK:SNG.UP-DK_5457",
            "SVK:SNG.UP-DK_5458",
            "SVK:SNG.UP-DK_5459",
            "SVK:SNG.UP-F_58-62",
            "SVK:SNG.K_17320",
            "SVK:SNG.UP-DK_5460",
            "SVK:SNG.UP-P_2987",
            "SVK:SNG.UP-DK_151",
            "SVK:SNG.UP-DK_90",
            "SVK:SNG.UP-T_252",
            "SVK:SNG.UP-T_286",
            "SVK:SNG.UP-DK_630",
            "SVK:SNG.UP-DK_5329",
            "SVK:SNG.UP-T_80",
            "SVK:SNG.UP-DK_5235",
            "SVK:SNG.UP-DK_162",
            "SVK:SNG.UP-DK_5330",
            "SVK:SNG.Z_10328",
            "SVK:SNG.P_2431",
            "SVK:SNG.UP-F_723",
            "SVK:SNG.UP-P_2992",
            "SVK:SNG.UP-F_675",
            "SVK:SNG.UP-DK_197",
            "SVK:SNG.UP-DK_130",
            "SVK:SNG.UP-DK_142",
            "SVK:SNG.UPR-F_3",
            "SVK:SNG.UPS-K_6-Z-6",
            "SVK:SNG.UP-DK_4727",
            "SVK:SNG.UP-F_1203",
            "SVK:SNG.UP-T_7-1-3",
            "SVK:SNG.UP-P_1297",
            "SVK:SNG.UP-DK_5227",
            "SVK:SNG.UP-DK_738",
            "SVK:SNG.UP-T_153",
            "SVK:SNG.UP-T_365",
            "SVK:SNG.UP-T_580",
            "SVK:SNG.UP-T_534",
            "SVK:SNG.UP-P_3068",
            "SVK:SNG.UP-T_624",
            "SVK:SNG.UP-T_341",
            "SVK:SNG.UP-T_345",
            "SVK:SNG.UP-T_340",
            "SVK:SNG.UP-T_619",
            "SVK:SNG.UP-DK_455",
            "SVK:SNG.UP-F_1112",
            "SVK:SNG.UP-F_399",
            "SVK:SNG.UP-F_213",
            "SVK:GMB.D_1",
            "SVK:SNG.UP-F_495-2",
            "SVK:SNG.P_1939",
            "SVK:SNG.UP-T_99",
            "SVK:SNG.UP-T_162",
            "SVK:SNG.UP-T_483",
            "SVK:SNG.UPS-K_15-M-2-3",
            "SVK:SNG.UPS-N_33",
          ];

        foreach ($item_ids as $id) {
            $item = new Item();
            $item->id = $id;
            $item->save();
        }
    }
}
