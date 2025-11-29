<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;

class BaiVietSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Dữ liệu mẫu ban đầu (đã thêm danh_muc_id)
        $data = [
            [
                'tieu_de' => 'Top 5 Ngôi Sao Bóng Đá Đang Thống Trị Thế Giới',
                'noi_dung' => 'Bóng đá thế giới đang chứng kiến sự vươn lên mạnh mẽ của nhiều ngôi sao trẻ đầy triển vọng. Những cái tên như Kylian Mbappé, Erling Haaland hay Vinícius Jr. đang liên tục lập công và phá vỡ các kỷ lục tại châu Âu. Tốc độ, sức mạnh và khả năng dứt điểm chính xác đã biến họ trở thành nỗi ám ảnh của mọi hàng thủ.',
                'anh_dai_dien' => 'https://i.pinimg.com/736x/ab/23/e1/ab23e13afcf13a67dfc41943a7507c23.jpg',
                'danh_muc_id' => 1,
            ],
            [
                'tieu_de' => 'Những Chiến Thuật Đang Làm Thay Đổi Bóng Đá Hiện Đại',
                'noi_dung' => 'Bóng đá hiện đại không chỉ dựa vào kỹ thuật cá nhân mà còn phụ thuộc rất lớn vào hệ thống chiến thuật. Những sơ đồ như 4-3-3, 3-4-3 hay 4-2-3-1 đang được nhiều HLV hàng đầu áp dụng để tối ưu hóa khả năng kiểm soát bóng. Bên cạnh đó, chiến thuật pressing tầm cao và phản công nhanh đang trở thành xu hướng mạnh mẽ.',
                'anh_dai_dien' => 'https://i.pinimg.com/736x/ab/23/e1/ab23e13afcf13a67dfc41943a7507c23.jpg',
                'danh_muc_id' => 1,
            ],
            [
                'tieu_de' => 'Việt Nam và Hành Trình Vươn Tầm Châu Lục',
                'noi_dung' => 'Đội tuyển Việt Nam đang có nhiều bước tiến quan trọng trên bản đồ bóng đá châu Á. Những thành tích nổi bật như vào tứ kết Asian Cup hay thi đấu ấn tượng tại vòng loại World Cup đã tạo nên động lực lớn cho bóng đá nước nhà.',
                'anh_dai_dien' => 'https://i.pinimg.com/736x/ab/23/e1/ab23e13afcf13a67dfc41943a7507c23.jpg',
                'danh_muc_id' => 1,
            ],
            [
                'tieu_de' => 'Cách Các CLB Lớn Kiếm Tiền Từ Bóng Đá',
                'noi_dung' => 'Các câu lạc bộ bóng đá lớn trên thế giới có nguồn thu khổng lồ từ nhiều lĩnh vực như bán vé, bản quyền truyền hình, tài trợ và bán áo đấu. Real Madrid, Barcelona hay Manchester United mỗi năm thu hàng tỷ đô nhờ vào thương hiệu toàn cầu.',
                'anh_dai_dien' => 'https://i.pinimg.com/736x/ab/23/e1/ab23e13afcf13a67dfc41943a7507c23.jpg',
                'danh_muc_id' => 2,
            ],
            [
                'tieu_de' => 'Hậu Trường Một Trận Đấu Bóng Đá Chuyên Nghiệp',
                'noi_dung' => 'Ít ai biết rằng để tổ chức một trận đấu bóng đá chuyên nghiệp, hàng trăm nhân sự phải làm việc liên tục. Từ đội ngũ an ninh, tổ trọng tài, nhân viên kỹ thuật cho đến ban huấn luyện, tất cả đều phối hợp nhịp nhàng để đảm bảo trận đấu diễn ra suôn sẻ.',
                'anh_dai_dien' => 'https://i.pinimg.com/736x/ab/23/e1/ab23e13afcf13a67dfc41943a7507c23.jpg',
                'danh_muc_id' => 2,
            ],
            [
                'tieu_de' => 'VAR – Công Nghệ Gây Tranh Cãi Nhưng Cần Thiết',
                'noi_dung' => 'Công nghệ VAR đã thay đổi bóng đá theo hướng minh bạch hơn, giúp trọng tài có thêm cơ sở để ra quyết định chính xác. Dù vậy, nhiều chuyên gia cho rằng VAR vẫn cần thiết để đảm bảo sự công bằng, và tương lai công nghệ này sẽ tiếp tục được cải tiến.',
                'anh_dai_dien' => 'https://i.pinimg.com/736x/ab/23/e1/ab23e13afcf13a67dfc41943a7507c23.jpg',
                'danh_muc_id' => 2,
            ],
            [
                'tieu_de' => 'Những Trận Derby Nóng Bỏng Nhất Thế Giới',
                'noi_dung' => 'Derby luôn là những trận đấu không chỉ mang ý nghĩa chuyên môn mà còn chứa đựng sự thù địch lịch sử giữa hai đội bóng. Những trận siêu kinh điển như El Clásico, Derby Manchester, hay Derby Milan đều thu hút hàng triệu người xem.',
                'anh_dai_dien' => 'https://i.pinimg.com/736x/ab/23/e1/ab23e13afcf13a67dfc41943a7507c23.jpg',
                'danh_muc_id' => 2,
            ],
            [
                'tieu_de' => 'Tương Lai Của Bóng Đá Khi Trí Tuệ Nhân Tạo Lên Ngôi',
                'noi_dung' => 'AI đang được áp dụng để phân tích chiến thuật, dự đoán phong độ cầu thủ và tối ưu hóa công tác huấn luyện. Các CLB hàng đầu thế giới đã sử dụng dữ liệu lớn để đánh giá hiệu suất thi đấu và lên kế hoạch chuyển nhượng.',
                'anh_dai_dien' => 'https://i.pinimg.com/736x/ab/23/e1/ab23e13afcf13a67dfc41943a7507c23.jpg',
                'danh_muc_id' => 3,
            ],
            [
                'tieu_de' => 'Những Bàn Thắng Đẹp Nhất Mọi Thời Đại',
                'noi_dung' => 'Từ cú solo của Maradona năm 1986, pha xe đạp chổng ngược của Cristiano Ronaldo cho đến cú vô-lê đẳng cấp của Zidane, bóng đá luôn mang đến những khoảnh khắc đẹp đến nghẹt thở.',
                'anh_dai_dien' => 'https://i.pinimg.com/736x/ab/23/e1/ab23e13afcf13a67dfc41943a7507c23.jpg',
                'danh_muc_id' => 3,
            ],
            [
                'tieu_de' => 'Những Huyền Thoại Không Thể Bị Lãng Quên',
                'noi_dung' => 'Pele, Maradona, Zidane, Ronaldo Nazário… là những cái tên đã đi vào huyền thoại. Tài năng của họ không chỉ tạo nên dấu ấn trong lịch sử bóng đá mà còn truyền cảm hứng cho nhiều thế hệ.',
                'anh_dai_dien' => 'https://i.pinimg.com/736x/ab/23/e1/ab23e13afcf13a67dfc41943a7507c23.jpg',
                'danh_muc_id' => 3,
            ],
        ];

        $dataToInsert = [];

        // 2. Tối ưu hóa: Thu thập dữ liệu vào mảng trước khi chèn
        foreach ($data as $item) {
            $dataToInsert[] = [
                'tieu_de' => $item['tieu_de'],
                'slug' => Str::slug($item['tieu_de']),
                // Tối ưu hóa trường tom_tat: tự động tạo từ noi_dung
                'tom_tat' => Str::words($item['noi_dung'], 20, '...'),
                'noi_dung' => $item['noi_dung'],
                'anh_dai_dien' => $item['anh_dai_dien'],
                'video_url' => null,
                'nguoi_dung_id' => 1,
                'danh_muc_id' => $item['danh_muc_id'],
                'trang_thai' => 'Đã duyệt',
                'noi_bat' => false,
                'ngay_tao' => Carbon::now(),
                'ngay_cap_nhat' => Carbon::now(),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ];
        }

        // 3. Tối ưu hóa: Chèn tất cả dữ liệu chỉ với một lần gọi DB
        DB::table('bai_viets')->insert($dataToInsert);
    }
}
