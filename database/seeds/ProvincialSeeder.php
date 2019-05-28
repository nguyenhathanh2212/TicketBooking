<?php

use Illuminate\Database\Seeder;
use App\Models\Provincial;
use App\Models\Station;
use App\Models\TypeBus;

class ProvincialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Provincial::truncate();
        Station::truncate();
        TypeBus::truncate();
        $provincials = [
            'Đà Nẵng' => [
                [
                    'name' => 'Bến xe trung tâm đà nẵng',
                    'address' => '185 Tôn Đức Thắng, P. Hòa Minh, Liên Chiểu, Thành phố Đà Nẵng',
                    'latitude' => '16.060640',
                    'longitude' => '108.176760',
                    'phone' => '0905009498',
                ]
            ],
            'Quảng Bình' => [
                [
                    'name' => 'Bến xe Lệ Thủy',
                    'address' => 'Trần Hưng Đạo, Liên Thuỷ, Lệ Thủy, Quảng Bình',
                    'latitude' => '17.119810',
                    'longitude' => '106.815580',
                    'phone' => '0232 3512 407',
                ],
                [
                    'name' => 'Bến xe đồng hới',
                    'address' => 'Nguyễn Hữu Cảnh, Phường Hải Thịnh, Tp. Đồng Hới, Quảng Bình',
                    'latitude' => '17.466840',
                    'longitude' => '106.623170',
                    'phone' => '0232 3512 407',
                ],
                [
                    'name' => 'Bến xe ba đồn',
                    'address' => 'Khu Phố 1 Ba Đồn Huyện Quảng Trạch, TT. Ba Đồn, Quảng Trạch, Quảng Bình',
                    'latitude' => '17.753410',
                    'longitude' => '106.420311',
                    'phone' => '0232 3512 407',
                ]
            ],
            'Quảng Trị' => [
                [
                    'name' => 'Bến xe đông hà',
                    'address' => ' 425 Lê Duẩn, Đông Lễ, Đông Hà, Quảng Trị',
                    'latitude' => '16.812700',
                    'longitude' => '107.107960',
                    'phone' => '0233 3851 488',
                ],[
                    'name' => 'Bến xe hồ xá',
                    'address' => ' Lê Duẩn, TT. Hồ Xá, Vĩnh Linh, Quảng Trị',
                    'latitude' => '17.042550',
                    'longitude' => '107.024880',
                    'phone' => '0233 3820 215',
                ],
            ],
            'Hà Nội' => [
                [
                    'name' => 'Bến xe mỹ đình',
                    'address' => 'Mỹ Đình, Nam Từ Liêm, Hà Nội',
                    'latitude' => '11.151430',
                    'longitude' => '1106.593513',
                    'phone' => '0233 3820 215',
                ]
            ],
            'Phú Yên' => [
                [
                    'name' => 'Bến Xe Phú Yên',
                    'address' => 'Nguyễn Trãi, Phường 4, Tuy Hòa, Phú Yên',
                    'latitude' => '13.086390',
                    'longitude' => '109.306840',
                    'phone' => '0233 3820 215',
                ]
            ],
            'Khánh Hòa' => [
                [
                    'name' => 'Bến xe phía bắc nha trang',
                    'address' => 'Số 01 đường 2/4, Vĩnh Hòa, Nha Trang, Khánh Hòa',
                    'latitude' => '12.289200',
                    'longitude' => '109.203650',
                    'phone' => '0233 3820 215',
                ],
            ],
            'Đắk Lắk' => [
                [
                    'name' => 'Bến xe liên tỉnh Đăk Lăk',
                    'address' => 'Km4 - Đường Nguyễn Chí Thanh, Phường Tân An, Buôn Ma Thuột, province_vi Đắk Lắk',
                    'latitude' => '12.702880',
                    'longitude' => '108.077750',
                    'phone' => '0233 3820 215',
                ]
            ],
            'Bình Định' => [
                [
                    'name' => 'Bến xe khách Quy Nhơn',
                    'address' => 'Võ Liệu, Ghềnh Ráng, Tp. Qui Nhơn, Bình Định',
                    'latitude' => '13.751360',
                    'longitude' => '109.208790',
                    'phone' => '0233 3820 215',
                ]
            ],
            'Quảng Ngãi' => [
                [
                    'name' => 'Bến xe Quảng Ngãi',
                    'address' => 'Nghĩa Chánh Nam, Tp. Quảng Ngãi, Quảng Ngãi',
                    'latitude' => '15.083650',
                    'longitude' => '108.859120',
                    'phone' => '0233 3820 215',
                ]
            ],
            'TP HCM' => [
                [
                    'name' => 'Bến xe Miền Đông',
                    'address' => 'Đinh Bộ Lĩnh, Phường 26, Bình Thạnh, Bình Thạnh Hồ Chí Minh',
                    'latitude' => '10.362350',
                    'longitude' => '106.673880',
                    'phone' => '0233 3820 215',
                ]
            ],
            'Thừa Thiên Huế' => [
                [
                    'name' => 'Bến Xe Phía Nam Thành Phố Huế, Việt Nam',
                    'address' => '57 An Dương Vương, An Đông, Tp. Huế, Thừa Thiên Huếg',
                    'latitude' => '16.447930',
                    'longitude' => '107.609040',
                    'phone' => '0233 3820 215',
                ]
            ],
            'Nghệ An' => [
                [
                    'name' => 'Bến xe Vinh',
                    'address' => '77 Lê Lợi, Tp. Vinh, Nghệ An',
                    'latitude' => '18.679820',
                    'longitude' => '105.674480',
                    'phone' => '0233 3820 215',
                ]
            ],
            'Thanh Hóa' => [
                [
                    'name' => 'Bến Xe Khách Phía Nam Thanh Hóa',
                    'address' => '690 Quang Trung, P. Tân Sơn, Tp. Thanh Hoá, Thanh Hoá',
                    'latitude' => '19.748960',
                    'longitude' => '105.898530',
                    'phone' => '0233 3820 215',
                ]
            ],
            'Quảng Nam' => [
                [
                    'name' => 'Bến xe Nam Phước',
                    'address' => 'AH1, Duy Phước, Duy Xuyên, Quảng Nam',
                    'latitude' => '15.859910',
                    'longitude' => '108.274180',
                    'phone' => '0233 3820 215',
                ]
            ],
            'Gia Lai' => [
                [
                    'name' => 'Bến xe khách Đức Long Gia Lai Bus Station',
                    'address' => 'P.Trà Bá, Tp. Pleiku, Gia Lai',
                    'latitude' => '20.980720',
                    'longitude' => '105.841958',
                    'phone' => '0233 3820 215',
                ]
            ],
            'Ninh Thuận' => [
                [
                    'name' => 'Bến xe khách Ninh Thuận',
                    'address' => 'Đài Sơn, Tp. Phan Rang - Tháp Chàm, Ninh Thuận',
                    'latitude' => '11.121590',
                    'longitude' => '106.192510',
                    'phone' => '0233 3820 215',
                ]
            ],
            'Hà Tĩnh' => [
                [
                    'name' => 'Bến Xe Khách Hà Tĩnh',
                    'address' => 'Hàm Nghi, Thạch Đài, Thạch Hà, Hà Tĩnh',
                    'latitude' => '20.435510',
                    'longitude' => '106.150800',
                    'phone' => '0239 3857 768',
                ]
            ],
        ];

        foreach ($provincials as $key => $value) {
            $provincial = Provincial::create(['name' => $key]);

            foreach ($value as $item) {
                $item['provincial_id'] = $provincial->id;
                Station::create($item);
            }
        }

        // type bus
        TypeBus::create([
            'name' => 'Xe ghế ngồi 29 chỗ',
            'number_of_seats' => 29,
            'number_row' => 7,
            'number_level' => 1,
            'number_column' => 5,
            'map' => "[[1,1,1,1,1,1,1],[1,1,1,1,1,1,1],[0,0,0,0,0,0,1],[1,1,1,1,1,1,1],[1,1,1,1,1,1,1]]",
        ]);

        TypeBus::create([
            'name' => 'Xe giường nằm 46 chỗ',
            'number_of_seats' => 46,
            'number_row' => 7,
            'number_level' => 2,
            'number_column' => 5,
            'map' => "[[1,1,1,1,1,1,1],[0,0,0,0,0,0,1],[1,1,1,1,1,1,1],[0,0,0,0,0,0,1],[1,1,1,1,1,1,1]]",
        ]);
    }
}
