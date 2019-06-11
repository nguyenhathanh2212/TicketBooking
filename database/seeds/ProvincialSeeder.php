<?php

use Illuminate\Database\Seeder;
use App\Models\Provincial;
use App\Models\Station;
use App\Models\Company;
use App\Models\TypeBus;
use App\Models\User;
use App\Models\UserCompany;

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
        Company::truncate();
        TypeBus::truncate();
        User::truncate();
        UserCompany::truncate();

        $provincials = [
            'Đà Nẵng' => [
                [
                    'name' => 'Bến xe trung tâm đà nẵng',
                    'address' => '185 Tôn Đức Thắng, P. Hòa Minh, Liên Chiểu, Thành phố Đà Nẵng',
                    'latitude' => '16.060640',
                    'longitude' => '108.176760',
                    'phone' => '0905009498',
                    'companies' => [
                        [
                            'name' => 'Xe khách Danatranco',
                            'address' => 'Tổ 16 - Phường Hà An - Quận Cẩm Lệ - Đà Nẵng',
                            'description' => 'Với dòng xe Limousine đẳng cấp, cung cấp thông tin và tư vấn đặt chỗ các nhà xe Limousine tốt nhất.
                                 Là hãng xe mới chất lượng cao, uy tín, đảm bảo mang đến trải nghiệm cực kỳ thoải mái cho khách hàng.
                                 Là đơn vị đầu tiên đưa dòng xe Limousine cao cấp vào hoạt động trên các tuyến đường.
                                 Với phương châm : "khách hàng là người thân", cam kết sẽ mang đến cho quý khách một chuyến đi an toàn và thoải mái nhất.
                                 Sự hài lòng của quý khách là động lực phát triển của chúng tôi, hân hạnh phục vụ quý khách',
                            'phone' => '0905009498',
                        ],
                        [
                            'name' => 'Xe khách Tùng Vy',
                            'address' => 'Tổ 16 - Phường Hà An - Quận Cẩm Lệ - Đà Nẵng',
                            'description' => 'Với dòng xe Limousine đẳng cấp, cung cấp thông tin và tư vấn đặt chỗ các nhà xe Limousine tốt nhất.
                                 Là hãng xe mới chất lượng cao, uy tín, đảm bảo mang đến trải nghiệm cực kỳ thoải mái cho khách hàng.
                                 Là đơn vị đầu tiên đưa dòng xe Limousine cao cấp vào hoạt động trên các tuyến đường.
                                 Với phương châm : "khách hàng là người thân", cam kết sẽ mang đến cho quý khách một chuyến đi an toàn và thoải mái nhất.
                                 Sự hài lòng của quý khách là động lực phát triển của chúng tôi, hân hạnh phục vụ quý khách',
                            'phone' => '0905009498',
                        ],
                        [
                            'name' => 'Xe khách Tuấn Nam',
                            'address' => 'Quận Hải châu - Đà Nẵng',
                            'description' => 'Với dòng xe Limousine đẳng cấp, cung cấp thông tin và tư vấn đặt chỗ các nhà xe Limousine tốt nhất.
                                 Là hãng xe mới chất lượng cao, uy tín, đảm bảo mang đến trải nghiệm cực kỳ thoải mái cho khách hàng.
                                 Là đơn vị đầu tiên đưa dòng xe Limousine cao cấp vào hoạt động trên các tuyến đường.
                                 Với phương châm : "khách hàng là người thân", cam kết sẽ mang đến cho quý khách một chuyến đi an toàn và thoải mái nhất.
                                 Sự hài lòng của quý khách là động lực phát triển của chúng tôi, hân hạnh phục vụ quý khách',
                            'phone' => '0905009498',
                        ],
                    ],
                ]
            ],
            'Quảng Bình' => [
                [
                    'name' => 'Bến xe Lệ Thủy',
                    'address' => 'Trần Hưng Đạo, Liên Thuỷ, Lệ Thủy, Quảng Bình',
                    'latitude' => '17.119810',
                    'longitude' => '106.815580',
                    'phone' => '0232 3512 407',
                    'companies' => [
                        [
                            'name' => 'Nhà xe Lâm Huề',
                            'address' => '30 Trần Hưng Đạo – Lệ Thủy – Quảng Bình',
                            'description' => 'Với dòng xe Limousine đẳng cấp, cung cấp thông tin và tư vấn đặt chỗ các nhà xe Limousine tốt nhất.
                                 Là hãng xe mới chất lượng cao, uy tín, đảm bảo mang đến trải nghiệm cực kỳ thoải mái cho khách hàng.
                                 Là đơn vị đầu tiên đưa dòng xe Limousine cao cấp vào hoạt động trên các tuyến đường.
                                 Với phương châm : "khách hàng là người thân", cam kết sẽ mang đến cho quý khách một chuyến đi an toàn và thoải mái nhất.
                                 Sự hài lòng của quý khách là động lực phát triển của chúng tôi, hân hạnh phục vụ quý khách',
                            'phone' => '0905619619',
                        ],
                        [
                            'name' => 'Nhà xe Vinh Thanh',
                            'address' => '31 Trần Hưng Đạo– Lệ Thủy – Quảng Bình',
                            'description' => 'Với dòng xe Limousine đẳng cấp, cung cấp thông tin và tư vấn đặt chỗ các nhà xe Limousine tốt nhất.
                                 Là hãng xe mới chất lượng cao, uy tín, đảm bảo mang đến trải nghiệm cực kỳ thoải mái cho khách hàng.
                                 Là đơn vị đầu tiên đưa dòng xe Limousine cao cấp vào hoạt động trên các tuyến đường.
                                 Với phương châm : "khách hàng là người thân", cam kết sẽ mang đến cho quý khách một chuyến đi an toàn và thoải mái nhất.
                                 Sự hài lòng của quý khách là động lực phát triển của chúng tôi, hân hạnh phục vụ quý khách',
                            'phone' => '0905619619',
                        ],
                    ],
                ],
                [
                    'name' => 'Bến xe đồng hới',
                    'address' => 'Nguyễn Hữu Cảnh, Phường Hải Thịnh, Tp. Đồng Hới, Quảng Bình',
                    'latitude' => '17.466840',
                    'longitude' => '106.623170',
                    'phone' => '0232 3512 407',
                    'companies' => [
                        [
                            'name' => 'Nhà xe Hải Hà',
                            'address' => '30 Quang Trung – Đồng Hới – Quảng Bình',
                            'description' => 'Với dòng xe Limousine đẳng cấp, cung cấp thông tin và tư vấn đặt chỗ các nhà xe Limousine tốt nhất.
                                 Là hãng xe mới chất lượng cao, uy tín, đảm bảo mang đến trải nghiệm cực kỳ thoải mái cho khách hàng.
                                 Là đơn vị đầu tiên đưa dòng xe Limousine cao cấp vào hoạt động trên các tuyến đường.
                                 Với phương châm : "khách hàng là người thân", cam kết sẽ mang đến cho quý khách một chuyến đi an toàn và thoải mái nhất.
                                 Sự hài lòng của quý khách là động lực phát triển của chúng tôi, hân hạnh phục vụ quý khách',
                            'phone' => '0905619619',
                        ],
                        [
                            'name' => 'Nhà xe Hạnh Luyến',
                            'address' => '31 Quang Trung – Đồng Hới – Quảng Bình',
                            'description' => 'Với dòng xe Limousine đẳng cấp, cung cấp thông tin và tư vấn đặt chỗ các nhà xe Limousine tốt nhất.
                                 Là hãng xe mới chất lượng cao, uy tín, đảm bảo mang đến trải nghiệm cực kỳ thoải mái cho khách hàng.
                                 Là đơn vị đầu tiên đưa dòng xe Limousine cao cấp vào hoạt động trên các tuyến đường.
                                 Với phương châm : "khách hàng là người thân", cam kết sẽ mang đến cho quý khách một chuyến đi an toàn và thoải mái nhất.
                                 Sự hài lòng của quý khách là động lực phát triển của chúng tôi, hân hạnh phục vụ quý khách',
                            'phone' => '0905619619',
                        ],
                        [
                            'name' => 'Nhà xe Trung Tín',
                            'address' => '28 Quang Trung – Đồng Hới – Quảng Bình',
                            'description' => 'Với dòng xe Limousine đẳng cấp, cung cấp thông tin và tư vấn đặt chỗ các nhà xe Limousine tốt nhất.
                                 Là hãng xe mới chất lượng cao, uy tín, đảm bảo mang đến trải nghiệm cực kỳ thoải mái cho khách hàng.
                                 Là đơn vị đầu tiên đưa dòng xe Limousine cao cấp vào hoạt động trên các tuyến đường.
                                 Với phương châm : "khách hàng là người thân", cam kết sẽ mang đến cho quý khách một chuyến đi an toàn và thoải mái nhất.
                                 Sự hài lòng của quý khách là động lực phát triển của chúng tôi, hân hạnh phục vụ quý khách',
                            'phone' => '0913494460',
                        ],
                        [
                            'name' => 'Nhà xe Vinh Thanh',
                            'address' => '20 Quang Trung – Đồng Hới – Quảng Bình',
                            'description' => 'Với dòng xe Limousine đẳng cấp, cung cấp thông tin và tư vấn đặt chỗ các nhà xe Limousine tốt nhất.
                                 Là hãng xe mới chất lượng cao, uy tín, đảm bảo mang đến trải nghiệm cực kỳ thoải mái cho khách hàng.
                                 Là đơn vị đầu tiên đưa dòng xe Limousine cao cấp vào hoạt động trên các tuyến đường.
                                 Với phương châm : "khách hàng là người thân", cam kết sẽ mang đến cho quý khách một chuyến đi an toàn và thoải mái nhất.
                                 Sự hài lòng của quý khách là động lực phát triển của chúng tôi, hân hạnh phục vụ quý khách',
                            'phone' => '0935735786',
                        ],
                    ],
                ],
                [
                    'name' => 'Bến xe ba đồn',
                    'address' => 'Khu Phố 1 Ba Đồn Huyện Quảng Trạch, TT. Ba Đồn, Quảng Trạch, Quảng Bình',
                    'latitude' => '17.753410',
                    'longitude' => '106.420311',
                    'phone' => '0232 3512 407',
                    'companies' => [
                        [
                            'name' => 'Nhà Xe Thanh Nghĩa',
                            'address' => '30 Trần Hưng Đạo – Lệ Thủy – Quảng Bình',
                            'description' => 'Với dòng xe Limousine đẳng cấp, cung cấp thông tin và tư vấn đặt chỗ các nhà xe Limousine tốt nhất.
                                 Là hãng xe mới chất lượng cao, uy tín, đảm bảo mang đến trải nghiệm cực kỳ thoải mái cho khách hàng.
                                 Là đơn vị đầu tiên đưa dòng xe Limousine cao cấp vào hoạt động trên các tuyến đường.
                                 Với phương châm : "khách hàng là người thân", cam kết sẽ mang đến cho quý khách một chuyến đi an toàn và thoải mái nhất.
                                 Sự hài lòng của quý khách là động lực phát triển của chúng tôi, hân hạnh phục vụ quý khách',
                            'phone' => '0905619619',
                        ],
                        [
                            'name' => 'Nhà xe xuân nghĩa',
                            'address' => '31 Trần Hưng Đạo– Lệ Thủy – Quảng Bình',
                            'description' => 'Với dòng xe Limousine đẳng cấp, cung cấp thông tin và tư vấn đặt chỗ các nhà xe Limousine tốt nhất.
                                 Là hãng xe mới chất lượng cao, uy tín, đảm bảo mang đến trải nghiệm cực kỳ thoải mái cho khách hàng.
                                 Là đơn vị đầu tiên đưa dòng xe Limousine cao cấp vào hoạt động trên các tuyến đường.
                                 Với phương châm : "khách hàng là người thân", cam kết sẽ mang đến cho quý khách một chuyến đi an toàn và thoải mái nhất.
                                 Sự hài lòng của quý khách là động lực phát triển của chúng tôi, hân hạnh phục vụ quý khách',
                            'phone' => '0905619619',
                        ],
                    ],
                ]
            ],
            'Quảng Trị' => [
                [
                    'name' => 'Bến xe đông hà',
                    'address' => ' 425 Lê Duẩn, Đông Lễ, Đông Hà, Quảng Trị',
                    'latitude' => '16.812700',
                    'longitude' => '107.107960',
                    'phone' => '0233 3851 488',
                    'companies' => [
                        [
                            'name' => 'Xe Hoàng Long',
                            'address' => '443 Lê Duẩn - Đông Hà - Quảng Trị',
                            'description' => 'Với dòng xe Limousine đẳng cấp, cung cấp thông tin và tư vấn đặt chỗ các nhà xe Limousine tốt nhất.
                                 Là hãng xe mới chất lượng cao, uy tín, đảm bảo mang đến trải nghiệm cực kỳ thoải mái cho khách hàng.
                                 Là đơn vị đầu tiên đưa dòng xe Limousine cao cấp vào hoạt động trên các tuyến đường.
                                 Với phương châm : "khách hàng là người thân", cam kết sẽ mang đến cho quý khách một chuyến đi an toàn và thoải mái nhất.
                                 Sự hài lòng của quý khách là động lực phát triển của chúng tôi, hân hạnh phục vụ quý khách',
                            'phone' => '0905619619',
                        ],
                        [
                            'name' => 'Xe Ngọc Trinh',
                            'address' => 'Cây xăng số 32, QL 1A, TT. Hồ Xá, Quảng Trị',
                            'description' => 'Với dòng xe Limousine đẳng cấp, cung cấp thông tin và tư vấn đặt chỗ các nhà xe Limousine tốt nhất.
                                 Là hãng xe mới chất lượng cao, uy tín, đảm bảo mang đến trải nghiệm cực kỳ thoải mái cho khách hàng.
                                 Là đơn vị đầu tiên đưa dòng xe Limousine cao cấp vào hoạt động trên các tuyến đường.
                                 Với phương châm : "khách hàng là người thân", cam kết sẽ mang đến cho quý khách một chuyến đi an toàn và thoải mái nhất.
                                 Sự hài lòng của quý khách là động lực phát triển của chúng tôi, hân hạnh phục vụ quý khách',
                            'phone' => '0905619619',
                        ],
                        [
                            'name' => 'Xe Tân Quang Dũng',
                            'address' => '115 Quốc Lộ 9, Phường 5 - Đông Hà - Quảng Trị',
                            'description' => 'Với dòng xe Limousine đẳng cấp, cung cấp thông tin và tư vấn đặt chỗ các nhà xe Limousine tốt nhất.
                                 Là hãng xe mới chất lượng cao, uy tín, đảm bảo mang đến trải nghiệm cực kỳ thoải mái cho khách hàng.
                                 Là đơn vị đầu tiên đưa dòng xe Limousine cao cấp vào hoạt động trên các tuyến đường.
                                 Với phương châm : "khách hàng là người thân", cam kết sẽ mang đến cho quý khách một chuyến đi an toàn và thoải mái nhất.
                                 Sự hài lòng của quý khách là động lực phát triển của chúng tôi, hân hạnh phục vụ quý khách',
                            'phone' => '0905619619',
                        ],
                    ],
                ],[
                    'name' => 'Bến xe hồ xá',
                    'address' => ' Lê Duẩn, TT. Hồ Xá, Vĩnh Linh, Quảng Trị',
                    'latitude' => '17.042550',
                    'longitude' => '107.024880',
                    'phone' => '0233 3820 215',
                    'companies' => [
                        [
                            'name' => 'Nhà xe Bích Ngọc',
                            'address' => '880 Tôn đức Thắng, Liên Chiểu, TP. Đà Nẵng',
                            'description' => 'Với dòng xe Limousine đẳng cấp, cung cấp thông tin và tư vấn đặt chỗ các nhà xe Limousine tốt nhất.
                                 Là hãng xe mới chất lượng cao, uy tín, đảm bảo mang đến trải nghiệm cực kỳ thoải mái cho khách hàng.
                                 Là đơn vị đầu tiên đưa dòng xe Limousine cao cấp vào hoạt động trên các tuyến đường.
                                 Với phương châm : "khách hàng là người thân", cam kết sẽ mang đến cho quý khách một chuyến đi an toàn và thoải mái nhất.
                                 Sự hài lòng của quý khách là động lực phát triển của chúng tôi, hân hạnh phục vụ quý khách',
                            'phone' => '0905619619',
                        ],
                        [
                            'name' => 'Nhà xe Huệ Thi',
                            'address' => 'TT. Hồ Xá, Vĩnh Linh, Quảng Trị, Vietnam',
                            'description' => 'Với dòng xe Limousine đẳng cấp, cung cấp thông tin và tư vấn đặt chỗ các nhà xe Limousine tốt nhất.
                                 Là hãng xe mới chất lượng cao, uy tín, đảm bảo mang đến trải nghiệm cực kỳ thoải mái cho khách hàng.
                                 Là đơn vị đầu tiên đưa dòng xe Limousine cao cấp vào hoạt động trên các tuyến đường.
                                 Với phương châm : "khách hàng là người thân", cam kết sẽ mang đến cho quý khách một chuyến đi an toàn và thoải mái nhất.
                                 Sự hài lòng của quý khách là động lực phát triển của chúng tôi, hân hạnh phục vụ quý khách',
                            'phone' => '0905619619',
                        ],
                        [
                            'name' => 'Nhà Xe Hoàng Nam',
                            'address' => 'TT. Hồ Xá, Vĩnh Linh, Quảng Trị, Vietnam',
                            'description' => 'Với dòng xe Limousine đẳng cấp, cung cấp thông tin và tư vấn đặt chỗ các nhà xe Limousine tốt nhất.
                                 Là hãng xe mới chất lượng cao, uy tín, đảm bảo mang đến trải nghiệm cực kỳ thoải mái cho khách hàng.
                                 Là đơn vị đầu tiên đưa dòng xe Limousine cao cấp vào hoạt động trên các tuyến đường.
                                 Với phương châm : "khách hàng là người thân", cam kết sẽ mang đến cho quý khách một chuyến đi an toàn và thoải mái nhất.
                                 Sự hài lòng của quý khách là động lực phát triển của chúng tôi, hân hạnh phục vụ quý khách',
                            'phone' => '0905619619',
                        ],
                    ],
                ],
            ],
            'Hà Nội' => [
                [
                    'name' => 'Bến xe mỹ đình',
                    'address' => 'Mỹ Đình, Nam Từ Liêm, Hà Nội',
                    'latitude' => '11.151430',
                    'longitude' => '1106.593513',
                    'phone' => '0233 3820 215',
                    'companies' => [
                        [
                            'name' => 'Nhà xe Phương Trang',
                            'address' => 'Mỹ Đình, Nam Từ Liêm, Hà Nội',
                            'description' => 'Với dòng xe Limousine đẳng cấp, cung cấp thông tin và tư vấn đặt chỗ các nhà xe Limousine tốt nhất.
                                 Là hãng xe mới chất lượng cao, uy tín, đảm bảo mang đến trải nghiệm cực kỳ thoải mái cho khách hàng.
                                 Là đơn vị đầu tiên đưa dòng xe Limousine cao cấp vào hoạt động trên các tuyến đường.
                                 Với phương châm : "khách hàng là người thân", cam kết sẽ mang đến cho quý khách một chuyến đi an toàn và thoải mái nhất.
                                 Sự hài lòng của quý khách là động lực phát triển của chúng tôi, hân hạnh phục vụ quý khách',
                            'phone' => '0905619619',
                        ],
                        [
                            'name' => 'XE KHÁCH PHƯƠNG TRANG',
                            'address' => 'Mỹ Đình, Nam Từ Liêm, Hà Nội',
                            'description' => 'Với dòng xe Limousine đẳng cấp, cung cấp thông tin và tư vấn đặt chỗ các nhà xe Limousine tốt nhất.
                                 Là hãng xe mới chất lượng cao, uy tín, đảm bảo mang đến trải nghiệm cực kỳ thoải mái cho khách hàng.
                                 Là đơn vị đầu tiên đưa dòng xe Limousine cao cấp vào hoạt động trên các tuyến đường.
                                 Với phương châm : "khách hàng là người thân", cam kết sẽ mang đến cho quý khách một chuyến đi an toàn và thoải mái nhất.
                                 Sự hài lòng của quý khách là động lực phát triển của chúng tôi, hân hạnh phục vụ quý khách',
                            'phone' => '0905619619',
                        ],
                        [
                            'name' => 'XE KHÁCH ĐẠI PHÁT',
                            'address' => 'Mỹ Đình, Nam Từ Liêm, Hà Nội',
                            'description' => 'Với dòng xe Limousine đẳng cấp, cung cấp thông tin và tư vấn đặt chỗ các nhà xe Limousine tốt nhất.
                                 Là hãng xe mới chất lượng cao, uy tín, đảm bảo mang đến trải nghiệm cực kỳ thoải mái cho khách hàng.
                                 Là đơn vị đầu tiên đưa dòng xe Limousine cao cấp vào hoạt động trên các tuyến đường.
                                 Với phương châm : "khách hàng là người thân", cam kết sẽ mang đến cho quý khách một chuyến đi an toàn và thoải mái nhất.
                                 Sự hài lòng của quý khách là động lực phát triển của chúng tôi, hân hạnh phục vụ quý khách',
                            'phone' => '0905619619',
                        ],
                        [
                            'name' => 'XE KHÁCH THANH SƠN',
                            'address' => 'Mỹ Đình, Nam Từ Liêm, Hà Nội',
                            'description' => 'Với dòng xe Limousine đẳng cấp, cung cấp thông tin và tư vấn đặt chỗ các nhà xe Limousine tốt nhất.
                                 Là hãng xe mới chất lượng cao, uy tín, đảm bảo mang đến trải nghiệm cực kỳ thoải mái cho khách hàng.
                                 Là đơn vị đầu tiên đưa dòng xe Limousine cao cấp vào hoạt động trên các tuyến đường.
                                 Với phương châm : "khách hàng là người thân", cam kết sẽ mang đến cho quý khách một chuyến đi an toàn và thoải mái nhất.
                                 Sự hài lòng của quý khách là động lực phát triển của chúng tôi, hân hạnh phục vụ quý khách',
                            'phone' => '0905619619',
                        ],
                    ],
                ]
            ],
            'Phú Yên' => [
                [
                    'name' => 'Bến Xe Phú Yên',
                    'address' => 'Nguyễn Trãi, Phường 4, Tuy Hòa, Phú Yên',
                    'latitude' => '13.086390',
                    'longitude' => '109.306840',
                    'phone' => '0233 3820 215',
                    'companies' => [
                        [
                            'name' => 'Xe Hoàng Long',
                            'address' => 'Chính Nghĩa, An Phú - Tuy Hòa - Phú Yên',
                            'description' => 'Với dòng xe Limousine đẳng cấp, cung cấp thông tin và tư vấn đặt chỗ các nhà xe Limousine tốt nhất.
                                 Là hãng xe mới chất lượng cao, uy tín, đảm bảo mang đến trải nghiệm cực kỳ thoải mái cho khách hàng.
                                 Là đơn vị đầu tiên đưa dòng xe Limousine cao cấp vào hoạt động trên các tuyến đường.
                                 Với phương châm : "khách hàng là người thân", cam kết sẽ mang đến cho quý khách một chuyến đi an toàn và thoải mái nhất.
                                 Sự hài lòng của quý khách là động lực phát triển của chúng tôi, hân hạnh phục vụ quý khách',
                            'phone' => '0905619619',
                        ],
                        [
                            'name' => 'Xe Phúc Thuận Thảo',
                            'address' => '227 Nguyễn Tất Thành - Tuy Hòa',
                            'description' => 'Với dòng xe Limousine đẳng cấp, cung cấp thông tin và tư vấn đặt chỗ các nhà xe Limousine tốt nhất.
                                 Là hãng xe mới chất lượng cao, uy tín, đảm bảo mang đến trải nghiệm cực kỳ thoải mái cho khách hàng.
                                 Là đơn vị đầu tiên đưa dòng xe Limousine cao cấp vào hoạt động trên các tuyến đường.
                                 Với phương châm : "khách hàng là người thân", cam kết sẽ mang đến cho quý khách một chuyến đi an toàn và thoải mái nhất.
                                 Sự hài lòng của quý khách là động lực phát triển của chúng tôi, hân hạnh phục vụ quý khách',
                            'phone' => '0905619619',
                        ],
                        [
                            'name' => 'Xe Thanh Thủy - Đà Lạt',
                            'address' => 'QL1A, Tuy Hòa - Tuy Hòa - Phú Yên',
                            'description' => 'Với dòng xe Limousine đẳng cấp, cung cấp thông tin và tư vấn đặt chỗ các nhà xe Limousine tốt nhất.
                                 Là hãng xe mới chất lượng cao, uy tín, đảm bảo mang đến trải nghiệm cực kỳ thoải mái cho khách hàng.
                                 Là đơn vị đầu tiên đưa dòng xe Limousine cao cấp vào hoạt động trên các tuyến đường.
                                 Với phương châm : "khách hàng là người thân", cam kết sẽ mang đến cho quý khách một chuyến đi an toàn và thoải mái nhất.
                                 Sự hài lòng của quý khách là động lực phát triển của chúng tôi, hân hạnh phục vụ quý khách',
                            'phone' => '0905619619',
                        ],
                    ],
                ]
            ],
            'Khánh Hòa' => [
                [
                    'name' => 'Bến xe phía bắc nha trang',
                    'address' => 'Số 01 đường 2/4, Vĩnh Hòa, Nha Trang, Khánh Hòa',
                    'latitude' => '12.289200',
                    'longitude' => '109.203650',
                    'phone' => '0233 3820 215',
                    'companies' => [
                        [
                            'name' => 'Xe Quang Hạnh',
                            'address' => 'Km số 6, Đường 23 tháng 10, Xã Vĩnh Trung - Nha Trang - Khánh Hòa',
                            'description' => 'Với dòng xe Limousine đẳng cấp, cung cấp thông tin và tư vấn đặt chỗ các nhà xe Limousine tốt nhất.
                                 Là hãng xe mới chất lượng cao, uy tín, đảm bảo mang đến trải nghiệm cực kỳ thoải mái cho khách hàng.
                                 Là đơn vị đầu tiên đưa dòng xe Limousine cao cấp vào hoạt động trên các tuyến đường.
                                 Với phương châm : "khách hàng là người thân", cam kết sẽ mang đến cho quý khách một chuyến đi an toàn và thoải mái nhất.
                                 Sự hài lòng của quý khách là động lực phát triển của chúng tôi, hân hạnh phục vụ quý khách',
                            'phone' => '0905619619',
                        ],
                        [
                            'name' => 'Nhà xe Liên Hưng',
                            'address' => 'Xã Vĩnh Trung - Nha Trang - Khánh Hòa',
                            'description' => 'Với dòng xe Limousine đẳng cấp, cung cấp thông tin và tư vấn đặt chỗ các nhà xe Limousine tốt nhất.
                                 Là hãng xe mới chất lượng cao, uy tín, đảm bảo mang đến trải nghiệm cực kỳ thoải mái cho khách hàng.
                                 Là đơn vị đầu tiên đưa dòng xe Limousine cao cấp vào hoạt động trên các tuyến đường.
                                 Với phương châm : "khách hàng là người thân", cam kết sẽ mang đến cho quý khách một chuyến đi an toàn và thoải mái nhất.
                                 Sự hài lòng của quý khách là động lực phát triển của chúng tôi, hân hạnh phục vụ quý khách',
                            'phone' => '0905619619',
                        ],
                        [
                            'name' => 'Nhà Xe Hà Linh',
                            'address' => 'Xã Vĩnh Trung - Nha Trang - Khánh Hòa',
                            'description' => 'Với dòng xe Limousine đẳng cấp, cung cấp thông tin và tư vấn đặt chỗ các nhà xe Limousine tốt nhất.
                                 Là hãng xe mới chất lượng cao, uy tín, đảm bảo mang đến trải nghiệm cực kỳ thoải mái cho khách hàng.
                                 Là đơn vị đầu tiên đưa dòng xe Limousine cao cấp vào hoạt động trên các tuyến đường.
                                 Với phương châm : "khách hàng là người thân", cam kết sẽ mang đến cho quý khách một chuyến đi an toàn và thoải mái nhất.
                                 Sự hài lòng của quý khách là động lực phát triển của chúng tôi, hân hạnh phục vụ quý khách',
                            'phone' => '0905619619',
                        ],
                    ],
                ],
            ],
            'Đắk Lắk' => [
                [
                    'name' => 'Bến xe liên tỉnh Đăk Lăk',
                    'address' => 'Km4 - Đường Nguyễn Chí Thanh, Phường Tân An, Buôn Ma Thuột, province_vi Đắk Lắk',
                    'latitude' => '12.702880',
                    'longitude' => '108.077750',
                    'phone' => '0233 3820 215',
                    'companies' => [
                        [
                            'name' => 'Xe Cao Nguyên',
                            'address' => 'Buôn Ma Thuột',
                            'description' => 'Với dòng xe Limousine đẳng cấp, cung cấp thông tin và tư vấn đặt chỗ các nhà xe Limousine tốt nhất.
                                 Là hãng xe mới chất lượng cao, uy tín, đảm bảo mang đến trải nghiệm cực kỳ thoải mái cho khách hàng.
                                 Là đơn vị đầu tiên đưa dòng xe Limousine cao cấp vào hoạt động trên các tuyến đường.
                                 Với phương châm : "khách hàng là người thân", cam kết sẽ mang đến cho quý khách một chuyến đi an toàn và thoải mái nhất.
                                 Sự hài lòng của quý khách là động lực phát triển của chúng tôi, hân hạnh phục vụ quý khách',
                            'phone' => '0905619619',
                        ],
                        [
                            'name' => 'Nhà xe Hải Vân',
                            'address' => 'Buôn Ma Thuột',
                            'description' => 'Với dòng xe Limousine đẳng cấp, cung cấp thông tin và tư vấn đặt chỗ các nhà xe Limousine tốt nhất.
                                 Là hãng xe mới chất lượng cao, uy tín, đảm bảo mang đến trải nghiệm cực kỳ thoải mái cho khách hàng.
                                 Là đơn vị đầu tiên đưa dòng xe Limousine cao cấp vào hoạt động trên các tuyến đường.
                                 Với phương châm : "khách hàng là người thân", cam kết sẽ mang đến cho quý khách một chuyến đi an toàn và thoải mái nhất.
                                 Sự hài lòng của quý khách là động lực phát triển của chúng tôi, hân hạnh phục vụ quý khách',
                            'phone' => '0905619619',
                        ],
                        [
                            'name' => 'Nhà Xe Tuấn Lợi',
                            'address' => 'Krông Năng',
                            'description' => 'Với dòng xe Limousine đẳng cấp, cung cấp thông tin và tư vấn đặt chỗ các nhà xe Limousine tốt nhất.
                                 Là hãng xe mới chất lượng cao, uy tín, đảm bảo mang đến trải nghiệm cực kỳ thoải mái cho khách hàng.
                                 Là đơn vị đầu tiên đưa dòng xe Limousine cao cấp vào hoạt động trên các tuyến đường.
                                 Với phương châm : "khách hàng là người thân", cam kết sẽ mang đến cho quý khách một chuyến đi an toàn và thoải mái nhất.
                                 Sự hài lòng của quý khách là động lực phát triển của chúng tôi, hân hạnh phục vụ quý khách',
                            'phone' => '0905619619',
                        ],
                    ],
                ]
            ],
            'Bình Định' => [
                [
                    'name' => 'Bến xe khách Quy Nhơn',
                    'address' => 'Võ Liệu, Ghềnh Ráng, Tp. Qui Nhơn, Bình Định',
                    'latitude' => '13.751360',
                    'longitude' => '109.208790',
                    'phone' => '0233 3820 215',
                    'companies' => [
                        [
                            'name' => 'Xe Hoàng Long',
                            'address' => '57 Võ Liệu, P. Ghềnh Ráng (gần BX Quy Nhơn)',
                            'description' => 'Với dòng xe Limousine đẳng cấp, cung cấp thông tin và tư vấn đặt chỗ các nhà xe Limousine tốt nhất.
                                 Là hãng xe mới chất lượng cao, uy tín, đảm bảo mang đến trải nghiệm cực kỳ thoải mái cho khách hàng.
                                 Là đơn vị đầu tiên đưa dòng xe Limousine cao cấp vào hoạt động trên các tuyến đường.
                                 Với phương châm : "khách hàng là người thân", cam kết sẽ mang đến cho quý khách một chuyến đi an toàn và thoải mái nhất.
                                 Sự hài lòng của quý khách là động lực phát triển của chúng tôi, hân hạnh phục vụ quý khách',
                            'phone' => '0905619619',
                        ],
                        [
                            'name' => 'Xe Kim Liên (Đà Nẵng)',
                            'address' => 'Bến xe Quy Nhơn',
                            'description' => 'Với dòng xe Limousine đẳng cấp, cung cấp thông tin và tư vấn đặt chỗ các nhà xe Limousine tốt nhất.
                                 Là hãng xe mới chất lượng cao, uy tín, đảm bảo mang đến trải nghiệm cực kỳ thoải mái cho khách hàng.
                                 Là đơn vị đầu tiên đưa dòng xe Limousine cao cấp vào hoạt động trên các tuyến đường.
                                 Với phương châm : "khách hàng là người thân", cam kết sẽ mang đến cho quý khách một chuyến đi an toàn và thoải mái nhất.
                                 Sự hài lòng của quý khách là động lực phát triển của chúng tôi, hân hạnh phục vụ quý khách',
                            'phone' => '0905619619',
                        ],
                        [
                            'name' => 'Xe Phúc Thuận Thảo',
                            'address' => 'QL 1A - Qui Nhơn',
                            'description' => 'Với dòng xe Limousine đẳng cấp, cung cấp thông tin và tư vấn đặt chỗ các nhà xe Limousine tốt nhất.
                                 Là hãng xe mới chất lượng cao, uy tín, đảm bảo mang đến trải nghiệm cực kỳ thoải mái cho khách hàng.
                                 Là đơn vị đầu tiên đưa dòng xe Limousine cao cấp vào hoạt động trên các tuyến đường.
                                 Với phương châm : "khách hàng là người thân", cam kết sẽ mang đến cho quý khách một chuyến đi an toàn và thoải mái nhất.
                                 Sự hài lòng của quý khách là động lực phát triển của chúng tôi, hân hạnh phục vụ quý khách',
                            'phone' => '0905619619',
                        ],
                    ],
                ]
            ],
            'Quảng Ngãi' => [
                [
                    'name' => 'Bến xe Quảng Ngãi',
                    'address' => 'Nghĩa Chánh Nam, Tp. Quảng Ngãi, Quảng Ngãi',
                    'latitude' => '15.083650',
                    'longitude' => '108.859120',
                    'phone' => '0233 3820 215',
                    'companies' => [
                        [
                            'name' => 'Xe Tánh Hạnh',
                            'address' => 'Nghĩa Kỳ - Tư Nghĩa - Quảng Ngãi',
                            'description' => 'Với dòng xe Limousine đẳng cấp, cung cấp thông tin và tư vấn đặt chỗ các nhà xe Limousine tốt nhất.
                                 Là hãng xe mới chất lượng cao, uy tín, đảm bảo mang đến trải nghiệm cực kỳ thoải mái cho khách hàng.
                                 Là đơn vị đầu tiên đưa dòng xe Limousine cao cấp vào hoạt động trên các tuyến đường.
                                 Với phương châm : "khách hàng là người thân", cam kết sẽ mang đến cho quý khách một chuyến đi an toàn và thoải mái nhất.
                                 Sự hài lòng của quý khách là động lực phát triển của chúng tôi, hân hạnh phục vụ quý khách',
                            'phone' => '0905619619',
                        ],
                        [
                            'name' => 'Xe Trường Thịnh',
                            'address' => 'Quốc lộ 1A, Đức Chánh - Mộ Đức',
                            'description' => 'Với dòng xe Limousine đẳng cấp, cung cấp thông tin và tư vấn đặt chỗ các nhà xe Limousine tốt nhất.
                                 Là hãng xe mới chất lượng cao, uy tín, đảm bảo mang đến trải nghiệm cực kỳ thoải mái cho khách hàng.
                                 Là đơn vị đầu tiên đưa dòng xe Limousine cao cấp vào hoạt động trên các tuyến đường.
                                 Với phương châm : "khách hàng là người thân", cam kết sẽ mang đến cho quý khách một chuyến đi an toàn và thoải mái nhất.
                                 Sự hài lòng của quý khách là động lực phát triển của chúng tôi, hân hạnh phục vụ quý khách',
                            'phone' => '0905619619',
                        ],
                    ],
                ]
            ],
            'TP HCM' => [
                [
                    'name' => 'Bến xe Miền Đông',
                    'address' => 'Đinh Bộ Lĩnh, Phường 26, Bình Thạnh, Bình Thạnh Hồ Chí Minh',
                    'latitude' => '10.362350',
                    'longitude' => '106.673880',
                    'phone' => '0233 3820 215',
                    'companies' => [
                        [
                            'name' => 'Xe Ba Nga',
                            'address' => 'Bến xe Miền Đông',
                            'description' => 'Với dòng xe Limousine đẳng cấp, cung cấp thông tin và tư vấn đặt chỗ các nhà xe Limousine tốt nhất.
                                 Là hãng xe mới chất lượng cao, uy tín, đảm bảo mang đến trải nghiệm cực kỳ thoải mái cho khách hàng.
                                 Là đơn vị đầu tiên đưa dòng xe Limousine cao cấp vào hoạt động trên các tuyến đường.
                                 Với phương châm : "khách hàng là người thân", cam kết sẽ mang đến cho quý khách một chuyến đi an toàn và thoải mái nhất.
                                 Sự hài lòng của quý khách là động lực phát triển của chúng tôi, hân hạnh phục vụ quý khách',
                            'phone' => '0905619619',
                        ],
                        [
                            'name' => 'Xe Cẩm Vân',
                            'address' => '49 Tân Thành, P. Hòa Thạnh - Tân Phú',
                            'description' => 'Với dòng xe Limousine đẳng cấp, cung cấp thông tin và tư vấn đặt chỗ các nhà xe Limousine tốt nhất.
                                 Là hãng xe mới chất lượng cao, uy tín, đảm bảo mang đến trải nghiệm cực kỳ thoải mái cho khách hàng.
                                 Là đơn vị đầu tiên đưa dòng xe Limousine cao cấp vào hoạt động trên các tuyến đường.
                                 Với phương châm : "khách hàng là người thân", cam kết sẽ mang đến cho quý khách một chuyến đi an toàn và thoải mái nhất.
                                 Sự hài lòng của quý khách là động lực phát triển của chúng tôi, hân hạnh phục vụ quý khách',
                            'phone' => '0905619619',
                        ],
                        [
                            'name' => 'Xe Đình Nhân',
                            'address' => '306A Hồng Lạc, Phường 11 - Tân Bình',
                            'description' => 'Với dòng xe Limousine đẳng cấp, cung cấp thông tin và tư vấn đặt chỗ các nhà xe Limousine tốt nhất.
                                 Là hãng xe mới chất lượng cao, uy tín, đảm bảo mang đến trải nghiệm cực kỳ thoải mái cho khách hàng.
                                 Là đơn vị đầu tiên đưa dòng xe Limousine cao cấp vào hoạt động trên các tuyến đường.
                                 Với phương châm : "khách hàng là người thân", cam kết sẽ mang đến cho quý khách một chuyến đi an toàn và thoải mái nhất.
                                 Sự hài lòng của quý khách là động lực phát triển của chúng tôi, hân hạnh phục vụ quý khách',
                            'phone' => '0905619619',
                        ],
                    ],
                ]
            ],
            'Thừa Thiên Huế' => [
                [
                    'name' => 'Bến Xe Phía Nam Thành Phố Huế, Việt Nam',
                    'address' => '57 An Dương Vương, An Đông, Tp. Huế, Thừa Thiên Huếg',
                    'latitude' => '16.447930',
                    'longitude' => '107.609040',
                    'phone' => '0233 3820 215',
                    'companies' => [
                        [
                            'name' => 'Xe Huetourist',
                            'address' => '11 Nguyễn Công Trứ - Huế',
                            'description' => 'Với dòng xe Limousine đẳng cấp, cung cấp thông tin và tư vấn đặt chỗ các nhà xe Limousine tốt nhất.
                                 Là hãng xe mới chất lượng cao, uy tín, đảm bảo mang đến trải nghiệm cực kỳ thoải mái cho khách hàng.
                                 Là đơn vị đầu tiên đưa dòng xe Limousine cao cấp vào hoạt động trên các tuyến đường.
                                 Với phương châm : "khách hàng là người thân", cam kết sẽ mang đến cho quý khách một chuyến đi an toàn và thoải mái nhất.
                                 Sự hài lòng của quý khách là động lực phát triển của chúng tôi, hân hạnh phục vụ quý khách',
                            'phone' => '0905619619',
                        ],
                        [
                            'name' => 'Xe KT Travel Huế',
                            'address' => '37 Nguyễn Thái Học - P.Phú Hội - Huế',
                            'description' => 'Với dòng xe Limousine đẳng cấp, cung cấp thông tin và tư vấn đặt chỗ các nhà xe Limousine tốt nhất.
                                 Là hãng xe mới chất lượng cao, uy tín, đảm bảo mang đến trải nghiệm cực kỳ thoải mái cho khách hàng.
                                 Là đơn vị đầu tiên đưa dòng xe Limousine cao cấp vào hoạt động trên các tuyến đường.
                                 Với phương châm : "khách hàng là người thân", cam kết sẽ mang đến cho quý khách một chuyến đi an toàn và thoải mái nhất.
                                 Sự hài lòng của quý khách là động lực phát triển của chúng tôi, hân hạnh phục vụ quý khách',
                            'phone' => '0905619619',
                        ],
                        [
                            'name' => 'Xe HAV Limousine',
                            'address' => '97 An Dương Vương - Huế',
                            'description' => 'Với dòng xe Limousine đẳng cấp, cung cấp thông tin và tư vấn đặt chỗ các nhà xe Limousine tốt nhất.
                                 Là hãng xe mới chất lượng cao, uy tín, đảm bảo mang đến trải nghiệm cực kỳ thoải mái cho khách hàng.
                                 Là đơn vị đầu tiên đưa dòng xe Limousine cao cấp vào hoạt động trên các tuyến đường.
                                 Với phương châm : "khách hàng là người thân", cam kết sẽ mang đến cho quý khách một chuyến đi an toàn và thoải mái nhất.
                                 Sự hài lòng của quý khách là động lực phát triển của chúng tôi, hân hạnh phục vụ quý khách',
                            'phone' => '0905619619',
                        ],
                    ],
                ]
            ],
            'Nghệ An' => [
                [
                    'name' => 'Bến xe Vinh',
                    'address' => '77 Lê Lợi, Tp. Vinh, Nghệ An',
                    'latitude' => '18.679820',
                    'longitude' => '105.674480',
                    'phone' => '0233 3820 215',
                    'companies' => [
                        [
                            'name' => 'Xe Dương Hồng',
                            'address' => 'Bến xe Vinh',
                            'description' => 'Với dòng xe Limousine đẳng cấp, cung cấp thông tin và tư vấn đặt chỗ các nhà xe Limousine tốt nhất.
                                 Là hãng xe mới chất lượng cao, uy tín, đảm bảo mang đến trải nghiệm cực kỳ thoải mái cho khách hàng.
                                 Là đơn vị đầu tiên đưa dòng xe Limousine cao cấp vào hoạt động trên các tuyến đường.
                                 Với phương châm : "khách hàng là người thân", cam kết sẽ mang đến cho quý khách một chuyến đi an toàn và thoải mái nhất.
                                 Sự hài lòng của quý khách là động lực phát triển của chúng tôi, hân hạnh phục vụ quý khách',
                            'phone' => '0905619619',
                        ],
                        [
                            'name' => 'Xe Hoàng Long',
                            'address' => '41 Nguyễn Du - Vinh',
                            'description' => 'Với dòng xe Limousine đẳng cấp, cung cấp thông tin và tư vấn đặt chỗ các nhà xe Limousine tốt nhất.
                                 Là hãng xe mới chất lượng cao, uy tín, đảm bảo mang đến trải nghiệm cực kỳ thoải mái cho khách hàng.
                                 Là đơn vị đầu tiên đưa dòng xe Limousine cao cấp vào hoạt động trên các tuyến đường.
                                 Với phương châm : "khách hàng là người thân", cam kết sẽ mang đến cho quý khách một chuyến đi an toàn và thoải mái nhất.
                                 Sự hài lòng của quý khách là động lực phát triển của chúng tôi, hân hạnh phục vụ quý khách',
                            'phone' => '0905619619',
                        ],
                        [
                            'name' => 'Xe Nam Cường',
                            'address' => 'Vinh - Nghệ An',
                            'description' => 'Với dòng xe Limousine đẳng cấp, cung cấp thông tin và tư vấn đặt chỗ các nhà xe Limousine tốt nhất.
                                 Là hãng xe mới chất lượng cao, uy tín, đảm bảo mang đến trải nghiệm cực kỳ thoải mái cho khách hàng.
                                 Là đơn vị đầu tiên đưa dòng xe Limousine cao cấp vào hoạt động trên các tuyến đường.
                                 Với phương châm : "khách hàng là người thân", cam kết sẽ mang đến cho quý khách một chuyến đi an toàn và thoải mái nhất.
                                 Sự hài lòng của quý khách là động lực phát triển của chúng tôi, hân hạnh phục vụ quý khách',
                            'phone' => '0905619619',
                        ],
                    ],
                ]
            ],
            'Thanh Hóa' => [
                [
                    'name' => 'Bến Xe Khách Phía Nam Thanh Hóa',
                    'address' => '690 Quang Trung, P. Tân Sơn, Tp. Thanh Hoá, Thanh Hoá',
                    'latitude' => '19.748960',
                    'longitude' => '105.898530',
                    'phone' => '0233 3820 215',
                    'companies' => [
                        [
                            'name' => 'Xe Hoàng Long',
                            'address' => '690 Quang Trung 2 - Thanh Hóa',
                            'description' => 'Với dòng xe Limousine đẳng cấp, cung cấp thông tin và tư vấn đặt chỗ các nhà xe Limousine tốt nhất.
                                 Là hãng xe mới chất lượng cao, uy tín, đảm bảo mang đến trải nghiệm cực kỳ thoải mái cho khách hàng.
                                 Là đơn vị đầu tiên đưa dòng xe Limousine cao cấp vào hoạt động trên các tuyến đường.
                                 Với phương châm : "khách hàng là người thân", cam kết sẽ mang đến cho quý khách một chuyến đi an toàn và thoải mái nhất.
                                 Sự hài lòng của quý khách là động lực phát triển của chúng tôi, hân hạnh phục vụ quý khách',
                            'phone' => '0905619619',
                        ],
                        [
                            'name' => 'Xe Tú Tạc',
                            'address' => 'Bến xe phía Nam Thanh Hóa',
                            'description' => 'Với dòng xe Limousine đẳng cấp, cung cấp thông tin và tư vấn đặt chỗ các nhà xe Limousine tốt nhất.
                                 Là hãng xe mới chất lượng cao, uy tín, đảm bảo mang đến trải nghiệm cực kỳ thoải mái cho khách hàng.
                                 Là đơn vị đầu tiên đưa dòng xe Limousine cao cấp vào hoạt động trên các tuyến đường.
                                 Với phương châm : "khách hàng là người thân", cam kết sẽ mang đến cho quý khách một chuyến đi an toàn và thoải mái nhất.
                                 Sự hài lòng của quý khách là động lực phát triển của chúng tôi, hân hạnh phục vụ quý khách',
                            'phone' => '0905619619',
                        ],
                        [
                            'name' => 'Xe Tuấn Thành',
                            'address' => 'Cẩm Thủy - Thanh Hóa',
                            'description' => 'Với dòng xe Limousine đẳng cấp, cung cấp thông tin và tư vấn đặt chỗ các nhà xe Limousine tốt nhất.
                                 Là hãng xe mới chất lượng cao, uy tín, đảm bảo mang đến trải nghiệm cực kỳ thoải mái cho khách hàng.
                                 Là đơn vị đầu tiên đưa dòng xe Limousine cao cấp vào hoạt động trên các tuyến đường.
                                 Với phương châm : "khách hàng là người thân", cam kết sẽ mang đến cho quý khách một chuyến đi an toàn và thoải mái nhất.
                                 Sự hài lòng của quý khách là động lực phát triển của chúng tôi, hân hạnh phục vụ quý khách',
                            'phone' => '0905619619',
                        ],
                    ],
                ]
            ],
            'Quảng Nam' => [
                [
                    'name' => 'Bến xe Nam Phước',
                    'address' => 'AH1, Duy Phước, Duy Xuyên, Quảng Nam',
                    'latitude' => '15.859910',
                    'longitude' => '108.274180',
                    'phone' => '0233 3820 215',
                    'companies' => [
                        [
                            'name' => 'Xe Trường Thịnh',
                            'address' => 'Quốc lộ 1A - Núi Thành',
                            'description' => 'Với dòng xe Limousine đẳng cấp, cung cấp thông tin và tư vấn đặt chỗ các nhà xe Limousine tốt nhất.
                                 Là hãng xe mới chất lượng cao, uy tín, đảm bảo mang đến trải nghiệm cực kỳ thoải mái cho khách hàng.
                                 Là đơn vị đầu tiên đưa dòng xe Limousine cao cấp vào hoạt động trên các tuyến đường.
                                 Với phương châm : "khách hàng là người thân", cam kết sẽ mang đến cho quý khách một chuyến đi an toàn và thoải mái nhất.
                                 Sự hài lòng của quý khách là động lực phát triển của chúng tôi, hân hạnh phục vụ quý khách',
                            'phone' => '0905619619',
                        ],
                        [
                            'name' => 'Xe Hạnh Cafe',
                            'address' => '02 Thái Phiên - Hội An',
                            'description' => 'Với dòng xe Limousine đẳng cấp, cung cấp thông tin và tư vấn đặt chỗ các nhà xe Limousine tốt nhất.
                                 Là hãng xe mới chất lượng cao, uy tín, đảm bảo mang đến trải nghiệm cực kỳ thoải mái cho khách hàng.
                                 Là đơn vị đầu tiên đưa dòng xe Limousine cao cấp vào hoạt động trên các tuyến đường.
                                 Với phương châm : "khách hàng là người thân", cam kết sẽ mang đến cho quý khách một chuyến đi an toàn và thoải mái nhất.
                                 Sự hài lòng của quý khách là động lực phát triển của chúng tôi, hân hạnh phục vụ quý khách',
                            'phone' => '0905619619',
                        ],
                    ],
                ]
            ],
            'Ninh Thuận' => [
                [
                    'name' => 'Bến xe khách Ninh Thuận',
                    'address' => 'Đài Sơn, Tp. Phan Rang - Tháp Chàm, Ninh Thuận',
                    'latitude' => '11.121590',
                    'longitude' => '106.192510',
                    'phone' => '0233 3820 215',
                    'companies' => [
                        [
                            'name' => 'Nhà Xe Hà Linh',
                            'address' => 'Bến Xe Khách Tỉnh Ninh Thuận',
                            'description' => 'Với dòng xe Limousine đẳng cấp, cung cấp thông tin và tư vấn đặt chỗ các nhà xe Limousine tốt nhất.
                                 Là hãng xe mới chất lượng cao, uy tín, đảm bảo mang đến trải nghiệm cực kỳ thoải mái cho khách hàng.
                                 Là đơn vị đầu tiên đưa dòng xe Limousine cao cấp vào hoạt động trên các tuyến đường.
                                 Với phương châm : "khách hàng là người thân", cam kết sẽ mang đến cho quý khách một chuyến đi an toàn và thoải mái nhất.
                                 Sự hài lòng của quý khách là động lực phát triển của chúng tôi, hân hạnh phục vụ quý khách',
                            'phone' => '0905619619',
                        ],
                        [
                            'name' => 'Xe Hải Hoàng Gia',
                            'address' => 'ngã 5 Phú Hà, 230 Lê Duẩn - Phan Rang-Tháp Chàm',
                            'description' => 'Với dòng xe Limousine đẳng cấp, cung cấp thông tin và tư vấn đặt chỗ các nhà xe Limousine tốt nhất.
                                 Là hãng xe mới chất lượng cao, uy tín, đảm bảo mang đến trải nghiệm cực kỳ thoải mái cho khách hàng.
                                 Là đơn vị đầu tiên đưa dòng xe Limousine cao cấp vào hoạt động trên các tuyến đường.
                                 Với phương châm : "khách hàng là người thân", cam kết sẽ mang đến cho quý khách một chuyến đi an toàn và thoải mái nhất.
                                 Sự hài lòng của quý khách là động lực phát triển của chúng tôi, hân hạnh phục vụ quý khách',
                            'phone' => '0905619619',
                        ],
                        [
                            'name' => 'Việt Sơn Anh',
                            'address' => 'Cà Đú - Ninh Hải',
                            'description' => 'Với dòng xe Limousine đẳng cấp, cung cấp thông tin và tư vấn đặt chỗ các nhà xe Limousine tốt nhất.
                                 Là hãng xe mới chất lượng cao, uy tín, đảm bảo mang đến trải nghiệm cực kỳ thoải mái cho khách hàng.
                                 Là đơn vị đầu tiên đưa dòng xe Limousine cao cấp vào hoạt động trên các tuyến đường.
                                 Với phương châm : "khách hàng là người thân", cam kết sẽ mang đến cho quý khách một chuyến đi an toàn và thoải mái nhất.
                                 Sự hài lòng của quý khách là động lực phát triển của chúng tôi, hân hạnh phục vụ quý khách',
                            'phone' => '0905619619',
                        ],
                    ],
                ]
            ],
            'Hà Tĩnh' => [
                [
                    'name' => 'Bến Xe Khách Hà Tĩnh',
                    'address' => 'Hàm Nghi, Thạch Đài, Thạch Hà, Hà Tĩnh',
                    'latitude' => '20.435510',
                    'longitude' => '106.150800',
                    'phone' => '0239 3857 768',
                    'companies' => [
                        [
                            'name' => 'Nhà Xe Dương Hồng',
                            'address' => 'Dọc Quốc Lộ 1A - Hà Tĩnh',
                            'description' => 'Với dòng xe Limousine đẳng cấp, cung cấp thông tin và tư vấn đặt chỗ các nhà xe Limousine tốt nhất.
                                 Là hãng xe mới chất lượng cao, uy tín, đảm bảo mang đến trải nghiệm cực kỳ thoải mái cho khách hàng.
                                 Là đơn vị đầu tiên đưa dòng xe Limousine cao cấp vào hoạt động trên các tuyến đường.
                                 Với phương châm : "khách hàng là người thân", cam kết sẽ mang đến cho quý khách một chuyến đi an toàn và thoải mái nhất.
                                 Sự hài lòng của quý khách là động lực phát triển của chúng tôi, hân hạnh phục vụ quý khách',
                            'phone' => '0905619619',
                        ],
                        [
                            'name' => 'Xe Liên Hưng',
                            'address' => 'Dọc Quốc Lộ 1A - Hà Tĩnh',
                            'description' => 'Với dòng xe Limousine đẳng cấp, cung cấp thông tin và tư vấn đặt chỗ các nhà xe Limousine tốt nhất.
                                 Là hãng xe mới chất lượng cao, uy tín, đảm bảo mang đến trải nghiệm cực kỳ thoải mái cho khách hàng.
                                 Là đơn vị đầu tiên đưa dòng xe Limousine cao cấp vào hoạt động trên các tuyến đường.
                                 Với phương châm : "khách hàng là người thân", cam kết sẽ mang đến cho quý khách một chuyến đi an toàn và thoải mái nhất.
                                 Sự hài lòng của quý khách là động lực phát triển của chúng tôi, hân hạnh phục vụ quý khách',
                            'phone' => '0905619619',
                        ],
                        [
                            'name' => 'Xe Hoàng Long',
                            'address' => 'Dọc Quốc Lộ 1A - Hà Tĩnh',
                            'description' => 'Với dòng xe Limousine đẳng cấp, cung cấp thông tin và tư vấn đặt chỗ các nhà xe Limousine tốt nhất.
                                 Là hãng xe mới chất lượng cao, uy tín, đảm bảo mang đến trải nghiệm cực kỳ thoải mái cho khách hàng.
                                 Là đơn vị đầu tiên đưa dòng xe Limousine cao cấp vào hoạt động trên các tuyến đường.
                                 Với phương châm : "khách hàng là người thân", cam kết sẽ mang đến cho quý khách một chuyến đi an toàn và thoải mái nhất.
                                 Sự hài lòng của quý khách là động lực phát triển của chúng tôi, hân hạnh phục vụ quý khách',
                            'phone' => '0905619619',
                        ],
                    ],
                ]
            ],
        ];

        foreach ($provincials as $key => $value) {
            $provincial = Provincial::create(['name' => $key]);

            foreach ($value as $item) {
                $item['provincial_id'] = $provincial->id;
                $companies = $item['companies'];
                unset($item['companies']);
                $station = Station::create($item);
                
                foreach ($companies as $company) {
                    $company['station_id'] = $station->id;
                    $company = Company::create($company);
                    $manager = factory(User::class, 1)->create();
                    $company->userCompanies()->create([
                        'user_id' => $manager->first()->id,
                        'role' => config('setting.user.role_company.super_manager'),
                    ]);
                    $emplyees = factory(User::class, 2)->create();

                    foreach ($emplyees as $emplyee)
                    $company->userCompanies()->create([
                        'user_id' => $emplyee->id,
                        'role' => config('setting.user.role_company.manager'),
                    ]);
                }
            }
        }

        // type bus
        TypeBus::create([
            'name' => 'Xe ghế ngồi 29 chỗ',
            'number_of_seats' => 29,
            'number_row' => 7,
            'number_level' => 1,
            'number_column' => 5,
            'map' => "[[1,2,3,4,5,6,7],[8,9,10,11,12,13,14],[0,0,0,0,0,0,15],[16,17,18,19,20,21,22],[23,24,25,26,27,28,29]]",
        ]);

        TypeBus::create([
            'name' => 'Xe giường nằm 46 chỗ',
            'number_of_seats' => 46,
            'number_row' => 7,
            'number_level' => 2,
            'number_column' => 5,
            'map' => "[[1,2,3,4,5,6,7],[0,0,0,0,0,0,8],[9,10,11,12,13,14,15],[0,0,0,0,0,0,16],[17,18,19,20,21,22,23]]",
        ]);
    }
}
