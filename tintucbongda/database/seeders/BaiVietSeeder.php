<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;




class BaiVietSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            [
                'tieu_de' => 'Top 5 Ngôi Sao Bóng Đá Đang Thống Trị Thế Giới',
                'noi_dung' => 'Bóng đá thế giới đang chứng kiến sự vươn lên mạnh mẽ của nhiều ngôi sao trẻ đầy triển vọng.
        Những cái tên như Kylian Mbappé, Erling Haaland hay Vinícius Jr. đang liên tục lập công và phá vỡ các kỷ lục
        tại châu Âu. Tốc độ, sức mạnh và khả năng dứt điểm chính xác đã biến họ trở thành nỗi ám ảnh của mọi hàng thủ.
        Thế hệ cầu thủ trẻ hiện nay không chỉ tài năng mà còn có ý thức chuyên nghiệp cao, hứa hẹn đem lại những màn
        trình diễn mãn nhãn cho người hâm mộ bóng đá toàn cầu trong nhiều năm tới.',
                'anh_dai_dien' => 'https://i.pinimg.com/736x/ab/23/e1/ab23e13afcf13a67dfc41943a7507c23.jpg',
            ],
            [
                'tieu_de' => 'Những Chiến Thuật Đang Làm Thay Đổi Bóng Đá Hiện Đại',
                'noi_dung' => 'Bóng đá hiện đại không chỉ dựa vào kỹ thuật cá nhân mà còn phụ thuộc rất lớn vào hệ thống chiến thuật.
        Những sơ đồ như 4-3-3, 3-4-3 hay 4-2-3-1 đang được nhiều HLV hàng đầu áp dụng để tối ưu hóa khả năng kiểm soát bóng.
        Bên cạnh đó, chiến thuật pressing tầm cao và phản công nhanh đang trở thành xu hướng mạnh mẽ. Khi bóng đá phát triển,
        người ta thấy rõ vai trò quan trọng của nhà cầm quân trong việc kiểm soát trận đấu và khai thác điểm yếu của đối phương.',
                'anh_dai_dien' => 'https://i.pinimg.com/736x/ab/23/e1/ab23e13afcf13a67dfc41943a7507c23.jpg',
            ],
            [
                'tieu_de' => 'Việt Nam và Hành Trình Vươn Tầm Châu Lục',
                'noi_dung' => 'Đội tuyển Việt Nam đang có nhiều bước tiến quan trọng trên bản đồ bóng đá châu Á.
        Những thành tích nổi bật như vào tứ kết Asian Cup hay thi đấu ấn tượng tại vòng loại World Cup đã tạo nên động lực lớn
        cho bóng đá nước nhà. Các cầu thủ trẻ từ lò đào tạo HAGL, Hà Nội FC hay Viettel đang trưởng thành nhanh chóng và có cơ hội
        cọ xát ở đấu trường quốc tế. Với sự đầu tư bài bản, Việt Nam hoàn toàn có thể hướng đến mục tiêu tham dự World Cup trong tương lai gần.',
                'anh_dai_dien' => 'https://i.pinimg.com/736x/ab/23/e1/ab23e13afcf13a67dfc41943a7507c23.jpg',
            ],
            [
                'tieu_de' => 'Cách Các CLB Lớn Kiếm Tiền Từ Bóng Đá',
                'noi_dung' => 'Các câu lạc bộ bóng đá lớn trên thế giới có nguồn thu khổng lồ từ nhiều lĩnh vực như bán vé, bản quyền truyền hình,
        tài trợ và bán áo đấu. Real Madrid, Barcelona hay Manchester United mỗi năm thu hàng tỷ đô nhờ vào thương hiệu toàn cầu.
        Ngoài ra, việc xây dựng học viện trẻ và bán cầu thủ cũng là nguồn thu quan trọng. Điều này cho thấy bóng đá hiện đại đã trở thành
        một ngành công nghiệp thực sự, nơi mỗi quyết định kinh doanh đều có thể ảnh hưởng lớn đến thành công của đội bóng.',
                'anh_dai_dien' => 'https://i.pinimg.com/736x/ab/23/e1/ab23e13afcf13a67dfc41943a7507c23.jpg',
            ],
            [
                'tieu_de' => 'Hậu Trường Một Trận Đấu Bóng Đá Chuyên Nghiệp',
                'noi_dung' => 'Ít ai biết rằng để tổ chức một trận đấu bóng đá chuyên nghiệp, hàng trăm nhân sự phải làm việc liên tục.
        Từ đội ngũ an ninh, tổ trọng tài, nhân viên kỹ thuật cho đến ban huấn luyện, tất cả đều phối hợp nhịp nhàng để đảm bảo trận đấu diễn ra suôn sẻ.
        Các cầu thủ cũng phải tuân thủ chế độ ăn uống nghiêm ngặt, phục hồi thể lực và họp chiến thuật trước giờ bóng lăn.
        Đằng sau 90 phút trên sân là cả một hệ thống vận hành chuyên nghiệp.',
                'anh_dai_dien' => 'https://i.pinimg.com/736x/ab/23/e1/ab23e13afcf13a67dfc41943a7507c23.jpg',
            ],
            [
                'tieu_de' => 'VAR – Công Nghệ Gây Tranh Cãi Nhưng Cần Thiết',
                'noi_dung' => 'Công nghệ VAR đã thay đổi bóng đá theo hướng minh bạch hơn, giúp trọng tài có thêm cơ sở để ra quyết định chính xác.
        Tuy nhiên, VAR cũng gây ra nhiều tranh cãi khi khiến trận đấu bị gián đoạn hoặc các quyết định vẫn gây nhiều tranh luận.
        Dù vậy, nhiều chuyên gia cho rằng VAR vẫn cần thiết để đảm bảo sự công bằng, và tương lai công nghệ này sẽ tiếp tục được cải tiến.',
                'anh_dai_dien' => 'https://i.pinimg.com/736x/ab/23/e1/ab23e13afcf13a67dfc41943a7507c23.jpg',
            ],
            [
                'tieu_de' => 'Những Trận Derby Nóng Bỏng Nhất Thế Giới',
                'noi_dung' => 'Derby luôn là những trận đấu không chỉ mang ý nghĩa chuyên môn mà còn chứa đựng sự thù địch lịch sử giữa hai đội bóng.
        Những trận siêu kinh điển như El Clásico (Real Madrid vs Barcelona), Derby Manchester, hay Derby Milan đều thu hút hàng triệu người xem.
        Bầu không khí cuồng nhiệt, sự căng thẳng và những pha bóng máu lửa luôn khiến người hâm mộ không thể rời mắt.',
                'anh_dai_dien' => 'https://i.pinimg.com/736x/ab/23/e1/ab23e13afcf13a67dfc41943a7507c23.jpg',
            ],
            [
                'tieu_de' => 'Tương Lai Của Bóng Đá Khi Trí Tuệ Nhân Tạo Lên Ngôi',
                'noi_dung' => 'AI đang được áp dụng để phân tích chiến thuật, dự đoán phong độ cầu thủ và tối ưu hóa công tác huấn luyện.
        Các CLB hàng đầu thế giới đã sử dụng dữ liệu lớn để đánh giá hiệu suất thi đấu và lên kế hoạch chuyển nhượng.
        Trong tương lai, AI có thể giúp dự đoán chấn thương, nâng cao thể lực và thậm chí xây dựng mô phỏng chiến thuật trước trận đấu.',
                'anh_dai_dien' => 'https://i.pinimg.com/736x/ab/23/e1/ab23e13afcf13a67dfc41943a7507c23.jpg',
            ],
            [
                'tieu_de' => 'Những Bàn Thắng Đẹp Nhất Mọi Thời Đại',
                'noi_dung' => 'Từ cú solo của Maradona năm 1986, pha xe đạp chổng ngược của Cristiano Ronaldo cho đến cú vô-lê đẳng cấp của Zidane,
        bóng đá luôn mang đến những khoảnh khắc đẹp đến nghẹt thở. Những bàn thắng kinh điển không chỉ thể hiện kỹ thuật thượng thừa mà còn mang lại cảm xúc mãnh liệt cho người hâm mộ trên toàn thế giới.',
                'anh_dai_dien' => 'https://i.pinimg.com/736x/ab/23/e1/ab23e13afcf13a67dfc41943a7507c23.jpg',
            ],
            [
                'tieu_de' => 'Những Huyền Thoại Không Thể Bị Lãng Quên',
                'noi_dung' => 'Pele, Maradona, Zidane, Ronaldo Nazário… là những cái tên đã đi vào huyền thoại.
        Tài năng của họ không chỉ tạo nên dấu ấn trong lịch sử bóng đá mà còn truyền cảm hứng cho nhiều thế hệ.
        Dù đã giải nghệ, những di sản họ để lại vẫn sống mãi trong lòng người hâm mộ.',
                'anh_dai_dien' => 'https://i.pinimg.com/736x/ab/23/e1/ab23e13afcf13a67dfc41943a7507c23.jpg',
            ],
        ];
        foreach ($data as $item) {
            DB::table('bai_viets')->insert([
                'tieu_de' => $item['tieu_de'],
                'slug' => Str::slug($item['tieu_de']),
                'tom_tat' => null,
                'noi_dung' => $item['noi_dung'],
                'anh_dai_dien' => $item['anh_dai_dien'],
                'video_url' => null,
                'nguoi_dung_id' => 1, // tồn tại
                'danh_muc_id' => 1, // BẮT BUỘC → phải có bản ghi danh_muc id = 1
                'trang_thai' => 'active',
                'noi_bat' => false,
                'ngay_tao' => Carbon::now(),
                'ngay_cap_nhat' => Carbon::now(),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }
    }
}
