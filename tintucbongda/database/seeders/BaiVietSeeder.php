<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;




class BaiVietSeeder extends Seeder {
    public function run(): void {
        $data = [
            [
                'tieu_de' => 'Khám Phá Ẩm Thực Việt Nam',
                'noi_dung' => 'Ẩm thực Việt Nam là bức tranh phong phú và đầy màu sắc, phản ánh sự hòa quyện tinh tế giữa thiên nhiên, văn hóa và con người trên dải đất hình chữ S. Từ Bắc chí Nam, mỗi vùng miền lại sở hữu những hương vị riêng biệt nhưng vẫn giữ được nét chung là sự thanh nhẹ, hài hòa và tinh tế trong cách nêm nếm. Ở miền Bắc, ẩm thực chú trọng đến vị thanh, không quá cay hay quá ngọt, thể hiện trong những món ăn đã trở thành biểu tượng như phở Hà Nội với nước dùng trong veo, ngọt tự nhiên từ xương hầm, cùng mùi thơm nhẹ của quế hồi; hay bún chả với những miếng thịt nướng vàng ruộm, thơm lừng hòa quyện cùng nước chấm đậm đà. Tiến vào miền Trung, người ta lại cảm nhận sự mạnh mẽ, đậm đà trong từng món ăn – vùng đất nắng gió này sản sinh ra những hương vị cay nồng, mặn mà như bún bò Huế, mì Quảng, bánh bèo, bánh lọc… tất cả đều đậm dấu ấn của sự tỉ mỉ và tinh tế trong từng công đoạn chế biến. Miền Nam – nơi con người hào sảng và phóng khoáng – lại tái hiện điều đó trong ẩm thực qua vị ngọt thanh đặc trưng, nguyên liệu phong phú từ đồng bằng sông Cửu Long và sự sáng tạo không giới hạn. Bát canh chua cá lóc, đĩa cá kho tộ, ly trà đá bình dân hay tô hủ tiếu nóng hổi đều chứa đựng sự giản dị nhưng đầy ắp tình người. Điểm cuốn hút của ẩm thực Việt Nam còn nằm ở các món ăn đường phố – một “thiên đường” hương vị mà chỉ cần bước ra bất kỳ góc phố nào cũng có thể bắt gặp: bánh mì giòn rụm với pate béo ngậy, cà phê sữa đá thơm nồng khó cưỡng, hay những xiên thịt nướng phảng phất mùi khói rực lửa. Người Việt còn rất tinh tế trong việc kết hợp rau thơm và nước chấm – yếu tố tạo nên linh hồn cho món ăn. Nước mắm, chanh, tỏi, ớt, đường… chỉ là những thành phần đơn giản, nhưng khi hòa quyện đúng tỷ lệ lại tạo nên dư vị khó quên, khiến ẩm thực Việt Nam trở thành một trong những nền ẩm thực được yêu thích nhất trên thế giới. Qua bao thăng trầm lịch sử, ẩm thực Việt Nam không chỉ đơn thuần là nhu cầu ăn uống mà còn là sự gìn giữ bản sắc, là câu chuyện về vùng đất, con người và truyền thống lâu đời, khiến những ai đã từng thưởng thức đều mang trong lòng một sự lưu luyến khó tả.',
                'anh_dai_dien' => 'https://imgs.search.brave.com/9kAvQpGWYtKMpMH_rzXFGheQG82PoHg9hyRTzavN6cs/rs:fit:860:0:0:0/g:ce/aHR0cHM6Ly9hbmhu/Z2hldGh1YXR2aWV0/bmFtMjAyMi5jb20v/d3AtY29udGVudC91/cGxvYWRzLzIwMjUv/MDMvYW5oLWdhaS14/aW5oLWhvLWhhbmct/MTIud2VicA'
            ],
            [
                'tieu_de' => 'Lợi Ích Của Việc Tập Thể Dục',
                'noi_dung' => 'Tập thể dục không chỉ giúp cơ thể khỏe mạnh mà còn cải thiện tâm trạng và tăng cường sức đề kháng. Hãy dành ít nhất 30 phút mỗi ngày cho việc này để tạo thói quen tốt cho sức khỏe.',
                'anh_dai_dien' => 'https://imgs.search.brave.com/9kAvQpGWYtKMpMH_rzXFGheQG82PoHg9hyRTzavN6cs/rs:fit:860:0:0:0/g:ce/aHR0cHM6Ly9hbmhu/Z2hldGh1YXR2aWV0/bmFtMjAyMi5jb20v/d3AtY29udGVudC91/cGxvYWRzLzIwMjUv/MDMvYW5oLWdhaS14/aW5oLWhvLWhhbmct/MTIud2VicA'
            ],
            [
                'tieu_de' => 'Xu Hướng Thời Trang Năm 2023',
                'noi_dung' => 'Năm 2023 chứng kiến sự trở lại của nhiều xu hướng thời trang độc đáo, bao gồm các phong cách retro và vintage. Đặc biệt, màu sắc tươi sáng và họa tiết nổi bật đang được yêu thích.',
                'anh_dai_dien' => 'https://imgs.search.brave.com/9kAvQpGWYtKMpMH_rzXFGheQG82PoHg9hyRTzavN6cs/rs:fit:860:0:0:0/g:ce/aHR0cHM6Ly9hbmhu/Z2hldGh1YXR2aWV0/bmFtMjAyMi5jb20v/d3AtY29udGVudC91/cGxvYWRzLzIwMjUv/MDMvYW5oLWdhaS14/aW5oLWhvLWhhbmct/MTIud2VicA'
            ],
            [
                'tieu_de' => 'Cách Chăm Sóc Da Mùa Đông',
                'noi_dung' => 'Mùa đông là thời điểm da thường khô và mất nước. Để chăm sóc da hiệu quả, hãy duy trì độ ẩm bằng kem dưỡng và uống đủ nước hàng ngày.',
                'anh_dai_dien' => 'https://imgs.search.brave.com/9kAvQpGWYtKMpMH_rzXFGheQG82PoHg9hyRTzavN6cs/rs:fit:860:0:0:0/g:ce/aHR0cHM6Ly9hbmhu/Z2hldGh1YXR2aWV0/bmFtMjAyMi5jb20v/d3AtY29udGVudC91/cGxvYWRzLzIwMjUv/MDMvYW5oLWdhaS14/aW5oLWhvLWhhbmct/MTIud2VicA'
            ],
            [
                'tieu_de' => 'Du Lịch Đà Nẵng: Điểm Đến Không Thể Bỏ Qua',
                'noi_dung' => 'Đà Nẵng, với những bãi biển tuyệt đẹp và nhiều địa danh nổi tiếng, luôn là điểm đến hấp dẫn. Hãy khám phá Ngũ Hành Sơn, bãi biển Mỹ Khê và thưởng thức hải sản tươi ngon nơi đây.',
                'anh_dai_dien' => 'https://imgs.search.brave.com/9kAvQpGWYtKMpMH_rzXFGheQG82PoHg9hyRTzavN6cs/rs:fit:860:0:0:0/g:ce/aHR0cHM6Ly9hbmhu/Z2hldGh1YXR2aWV0/bmFtMjAyMi5jb20v/d3AtY29udGVudC91/cGxvYWRzLzIwMjUv/MDMvYW5oLWdhaS14/aW5oLWhvLWhhbmct/MTIud2VicA'
            ],
            [
                'tieu_de' => 'Sự Phát Triển Của Công Nghệ Thông Tin',
                'noi_dung' => 'Công nghệ thông tin đang ngày càng phát triển và ảnh hưởng sâu rộng đến mọi lĩnh vực. Từ giáo dục, y tế đến thương mại điện tử, sự tích hợp công nghệ đã đem lại nhiều lợi ích cho cuộc sống.',
                'anh_dai_dien' => 'https://imgs.search.brave.com/9kAvQpGWYtKMpMH_rzXFGheQG82PoHg9hyRTzavN6cs/rs:fit:860:0:0:0/g:ce/aHR0cHM6Ly9hbmhu/Z2hldGh1YXR2aWV0/bmFtMjAyMi5jb20v/d3AtY29udGVudC91/cGxvYWRzLzIwMjUv/MDMvYW5oLWdhaS14/aW5oLWhvLWhhbmct/MTIud2VicA'
            ],
            [
                'tieu_de' => 'Những Cuốn Sách Hay Nên Đọc',
                'noi_dung' => 'Nếu bạn đang tìm kiếm nguồn cảm hứng, hãy thử đọc những cuốn sách như "Đắc Nhân Tâm" của Dale Carnegie, "Sapiens" của Yuval Noah Harari hay "Ngày Xưa Có Một Con Bò" của Lê Hà.',
                'anh_dai_dien' => 'https://imgs.search.brave.com/9kAvQpGWYtKMpMH_rzXFGheQG82PoHg9hyRTzavN6cs/rs:fit:860:0:0:0/g:ce/aHR0cHM6Ly9hbmhu/Z2hldGh1YXR2aWV0/bmFtMjAyMi5jb20v/d3AtY29udGVudC91/cGxvYWRzLzIwMjUv/MDMvYW5oLWdhaS14/aW5oLWhvLWhhbmct/MTIud2VicA'
            ],
            [
                'tieu_de' => 'Bí Quyết Tạo Mối Quan Hệ Tốt',
                'noi_dung' => 'Mối quan hệ cá nhân rất quan trọng trong cuộc sống. Hãy lắng nghe, thấu hiểu và chia sẻ để xây dựng những mối quan hệ tốt đẹp hơn với mọi người xung quanh.',
                'anh_dai_dien' => 'https://imgs.search.brave.com/9kAvQpGWYtKMpMH_rzXFGheQG82PoHg9hyRTzavN6cs/rs:fit:860:0:0:0/g:ce/aHR0cHM6Ly9hbmhu/Z2hldGh1YXR2aWV0/bmFtMjAyMi5jb20v/d3AtY29udGVudC91/cGxvYWRzLzIwMjUv/MDMvYW5oLWdhaS14/aW5oLWhvLWhhbmct/MTIud2VicA'
            ],
            [
                'tieu_de' => 'Tìm Hiểu Về Thị Trường Chứng Khoán',
                'noi_dung' => 'Thị trường chứng khoán mang lại cơ hội đầu tư hấp dẫn, nhưng cũng chứa đựng nhiều rủi ro. Hãy trang bị kiến thức và nghiên cứu kỹ lưỡng trước khi quyết định đầu tư.',
                'anh_dai_dien' => 'https://imgs.search.brave.com/9kAvQpGWYtKMpMH_rzXFGheQG82PoHg9hyRTzavN6cs/rs:fit:860:0:0:0/g:ce/aHR0cHM6Ly9hbmhu/Z2hldGh1YXR2aWV0/bmFtMjAyMi5jb20v/d3AtY29udGVudC91/cGxvYWRzLzIwMjUv/MDMvYW5oLWdhaS14/aW5oLWhvLWhhbmct/MTIud2VicA'
            ],
            [
                'tieu_de' => 'Phát Triển Bản Thân Qua Sách',
                'noi_dung' => 'Sách không chỉ là nguồn kiến thức mà còn giúp phát triển tư duy và nhận thức. Hãy dành thời gian đọc sách mỗi ngày để mở mang tri thức.',
                'anh_dai_dien' => 'https://imgs.search.brave.com/9kAvQpGWYtKMpMH_rzXFGheQG82PoHg9hyRTzavN6cs/rs:fit:860:0:0:0/g:ce/aHR0cHM6Ly9hbmhu/Z2hldGh1YXR2aWV0/bmFtMjAyMi5jb20v/d3AtY29udGVudC91/cGxvYWRzLzIwMjUv/MDMvYW5oLWdhaS14/aW5oLWhvLWhhbmct/MTIud2VicA'
            ],
            [
                'tieu_de' => 'Giới Thiệu Về Yoga',
                'noi_dung' => 'Yoga không chỉ là một bộ môn thể dục mà còn là phương pháp giảm stress, cải thiện tinh thần và thể chất. Hãy thử tham gia các lớp yoga để trải nghiệm.',
                'anh_dai_dien' => 'https://imgs.search.brave.com/9kAvQpGWYtKMpMH_rzXFGheQG82PoHg9hyRTzavN6cs/rs:fit:860:0:0:0/g:ce/aHR0cHM6Ly9hbmhu/Z2hldGh1YXR2aWV0/bmFtMjAyMi5jb20v/d3AtY29udGVudC91/cGxvYWRzLzIwMjUv/MDMvYW5oLWdhaS14/aW5oLWhvLWhhbmct/MTIud2VicA'
            ],
            [
                'tieu_de' => 'Những Lợi Ích Của Việc Ngồi Thiền',
                'noi_dung' => 'Ngồi thiền giúp giảm căng thẳng, tăng cường sự tập trung và cải thiện sức khỏe tâm lý. Hãy dành 10-15 phút mỗi ngày để thiền định và cảm nhận sự khác biệt.',
                'anh_dai_dien' => 'https://imgs.search.brave.com/9kAvQpGWYtKMpMH_rzXFGheQG82PoHg9hyRTzavN6cs/rs:fit:860:0:0:0/g:ce/aHR0cHM6Ly9hbmhu/Z2hldGh1YXR2aWV0/bmFtMjAyMi5jb20v/d3AtY29udGVudC91/cGxvYWRzLzIwMjUv/MDMvYW5oLWdhaS14/aW5oLWhvLWhhbmct/MTIud2VicA'
            ],
            [
                'tieu_de' => 'Cách Lên Kế Hoạch Du Lịch Thông Minh',
                'noi_dung' => 'Lên kế hoạch cho chuyến du lịch không chỉ giúp tiết kiệm thời gian mà còn làm tăng trải nghiệm. Hãy khảo sát địa điểm, hoạt động và chi phí trước khi khởi hành.',
                'anh_dai_dien' => 'https://imgs.search.brave.com/9kAvQpGWYtKMpMH_rzXFGheQG82PoHg9hyRTzavN6cs/rs:fit:860:0:0:0/g:ce/aHR0cHM6Ly9hbmhu/Z2hldGh1YXR2aWV0/bmFtMjAyMi5jb20v/d3AtY29udGVudC91/cGxvYWRzLzIwMjUv/MDMvYW5oLWdhaS14/aW5oLWhvLWhhbmct/MTIud2VicA'
            ],
            [
                'tieu_de' => 'Khám Phá Nền Ẩm Thực Châu Á',
                'noi_dung' => 'Ẩm thực châu Á đa dạng và phong phú với nhiều hương vị độc đáo. Từ sushi Nhật Bản, phở Việt Nam đến dim sum Trung Quốc, mỗi món ăn đều có câu chuyện riêng.',
                'anh_dai_dien' => 'https://imgs.search.brave.com/9kAvQpGWYtKMpMH_rzXFGheQG82PoHg9hyRTzavN6cs/rs:fit:860:0:0:0/g:ce/aHR0cHM6Ly9hbmhu/Z2hldGh1YXR2aWV0/bmFtMjAyMi5jb20v/d3AtY29udGVudC91/cGxvYWRzLzIwMjUv/MDMvYW5oLWdhaS14/aW5oLWhvLWhhbmct/MTIud2VicA'
            ],
            [
                'tieu_de' => 'Lợi Ích Của Việc Học Ngoại Ngữ',
                'noi_dung' => 'Học ngoại ngữ mở ra cánh cửa đến với thế giới. Bạn sẽ có cơ hội giao tiếp, kết nối với nhiều người và khám phá văn hóa mới.',
                'anh_dai_dien' => 'https://imgs.search.brave.com/9kAvQpGWYtKMpMH_rzXFGheQG82PoHg9hyRTzavN6cs/rs:fit:860:0:0:0/g:ce/aHR0cHM6Ly9hbmhu/Z2hldGh1YXR2aWV0/bmFtMjAyMi5jb20v/d3AtY29udGVudC91/cGxvYWRzLzIwMjUv/MDMvYW5oLWdhaS14/aW5oLWhvLWhhbmct/MTIud2VicA'
            ],
            [
                'tieu_de' => 'Sự Kiện Thể Thao Nổi Bật Năm 2023',
                'noi_dung' => 'Năm 2023 chứng kiến nhiều sự kiện thể thao lớn như World Cup, Olympic… Đây là cơ hội để các vận động viên thể hiện tài năng và cống hiến cho môn thể thao của họ.',
                'anh_dai_dien' => 'https://imgs.search.brave.com/9kAvQpGWYtKMpMH_rzXFGheQG82PoHg9hyRTzavN6cs/rs:fit:860:0:0:0/g:ce/aHR0cHM6Ly9hbmhu/Z2hldGh1YXR2aWV0/bmFtMjAyMi5jb20v/d3AtY29udGVudC91/cGxvYWRzLzIwMjUv/MDMvYW5oLWdhaS14/aW5oLWhvLWhhbmct/MTIud2VicA'
            ],
            [
                'tieu_de' => 'Hướng Dẫn Xây Dựng Thói Quen Tốt',
                'noi_dung' => 'Xây dựng thói quen tốt giúp bạn nâng cao năng suất và cải thiện chất lượng cuộc sống. Hãy bắt đầu từ những thói quen nhỏ và nhân rộng chúng theo thời gian.',
                'anh_dai_dien' => 'https://imgs.search.brave.com/9kAvQpGWYtKMpMH_rzXFGheQG82PoHg9hyRTzavN6cs/rs:fit:860:0:0:0/g:ce/aHR0cHM6Ly9hbmhu/Z2hldGh1YXR2aWV0/bmFtMjAyMi5jb20v/d3AtY29udGVudC91/cGxvYWRzLzIwMjUv/MDMvYW5oLWdhaS14/aW5oLWhvLWhhbmct/MTIud2VicA'
            ],
            [
                'tieu_de' => 'Cách Tăng Cường Sức Khỏe Tâm Thần',
                'noi_dung' => 'Sức khỏe tâm thần cũng quan trọng như sức khỏe thể chất. Hãy tìm cách giữ gìn tâm trạng ổn định qua việc giao tiếp, tập thể dục và thư giãn.',
                'anh_dai_dien' => 'https://imgs.search.brave.com/9kAvQpGWYtKMpMH_rzXFGheQG82PoHg9hyRTzavN6cs/rs:fit:860:0:0:0/g:ce/aHR0cHM6Ly9hbmhu/Z2hldGh1YXR2aWV0/bmFtMjAyMi5jb20v/d3AtY29udGVudC91/cGxvYWRzLzIwMjUv/MDMvYW5oLWdhaS14/aW5oLWhvLWhhbmct/MTIud2VicA'
            ],
            [
                'tieu_de' => 'Những Địa Điểm Du Lịch Nổi Bật Ở Châu Âu',
                'noi_dung' => 'Châu Âu là nơi có nhiều điểm đến hấp dẫn như Paris, Rome, London... Hãy lên kế hoạch khám phá lịch sử, văn hóa và ẩm thực nơi đây.',
                'anh_dai_dien' => 'https://imgs.search.brave.com/9kAvQpGWYtKMpMH_rzXFGheQG82PoHg9hyRTzavN6cs/rs:fit:860:0:0:0/g:ce/aHR0cHM6Ly9hbmhu/Z2hldGh1YXR2aWV0/bmFtMjAyMi5jb20v/d3AtY29udGVudC91/cGxvYWRzLzIwMjUv/MDMvYW5oLWdhaS14/aW5oLWhvLWhhbmct/MTIud2VicA'
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
