<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('新增冰箱') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                <section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('冰箱資料') }}
        </h2>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>
    <form method="POST" action="{{ route('add.fridge') }}" class="mt-6 space-y-6">
        @csrf


        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('冰箱名稱')" />
            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <script src="{{ asset('js/twolayerselect.js') }}"></script>
        <div>
            <x-input-label for="city" :value="__('City')" />
            <select id="city" name="city" class="mt-1 block w-full" required>
                <option value="none" selected disabled hidden>{{ __('Select a county') }}</option>
                <!-- Add your county options here -->
                <option value="基隆市">{{ __('基隆市') }}</option>
                <option value="臺北市">{{ __('臺北市') }}</option>
                <option value="新北市">{{ __('新北市') }}</option>
                <option value="桃園市">{{ __('桃園市') }}</option>
                <option value="新竹市">{{ __('新竹市') }}</option>
                <option value="新竹縣">{{ __('新竹縣') }}</option>
                <option value="苗栗縣">{{ __('苗栗縣') }}</option>
                <option value="臺中市">{{ __('臺中市') }}</option>
                <option value="彰化縣">{{ __('彰化縣') }}</option>
                <option value="南投縣">{{ __('南投縣') }}</option>
                <option value="雲林縣">{{ __('雲林縣') }}</option>
                <option value="嘉義市">{{ __('嘉義市') }}</option>
                <option value="嘉義縣">{{ __('嘉義縣') }}</option>
                <option value="臺南市">{{ __('臺南市') }}</option>
                <option value="高雄市">{{ __('高雄市') }}</option>
                <option value="屏東縣">{{ __('屏東縣') }}</option>
                <option value="臺東縣">{{ __('臺東縣') }}</option>
                <option value="花蓮縣">{{ __('花蓮縣') }}</option>
                <option value="宜蘭縣">{{ __('宜蘭縣') }}</option>
                <option value="澎湖縣">{{ __('澎湖縣') }}</option>
                <option value="金門縣">{{ __('金門縣') }}</option>
                <option value="連江縣">{{ __('連江縣') }}</option>
                <!-- ... other options ... -->
            </select>
        </div>
        <div>
            <x-input-label for="dist" :value="__('Dist')" />
            <select id="dist" name="dist" class="mt-1 block w-full" required>
                <option value="none" selected disabled hidden>{{ __('Select an area') }}</option>
                 <!-- This dropdown will be populated dynamically based on the selected county -->
            </select>
        </div>
    

        <div>
            <x-input-label for="address" :value="__('地址')" />
            <x-text-input id="address" name="address" type="text" class="mt-1 block w-full" :value="old('address')" required autofocus autocomplete="address" />
            <x-input-error class="mt-2" :messages="$errors->get('address')" />
        </div>

        <div>
            <x-input-label for="company" :value="__('組織')" />
            <x-text-input id="company" name="company" type="text" class="mt-1 block w-full" :value="old('company', $user->company)" required autofocus autocomplete="company" />
            <x-input-error class="mt-2" :messages="$errors->get('company')" />
        </div>

        <div>
            <x-input-label for="telephone" :value="__('電話')" />
            <x-text-input id="telephone" name="telephone" type="text" class="mt-1 block w-full" :value="old('telephone', $user->telephone)" required autofocus autocomplete="telephone" />
            <x-input-error class="mt-2" :messages="$errors->get('telephone')" />
        </div>

        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email', $user->email)" required autocomplete="username" />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('儲 存') }}</x-primary-button>

            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600"
                >{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
</section>

<script>
    const distsByCounty = {
        "基隆市": ["中正區", "七堵區", "暖暖區", "仁愛區", "中山區", "安樂區", "信義區"],
        "臺北市": ["松山區", "信義區", "大安區", "中山區", "中正區", "大同區", "萬華區",
            "文山區", "南港區", "內湖區", "士林區", "北投區"],
        "新北市": ["板橋區", "三重區", "中和區", "永和區", "新莊區", "新店區", "樹林區",
            "鶯歌區", "三峽區", "淡水區", "汐止區", "瑞芳區", "土城區", "蘆洲區",
            "五股區", "泰山區", "林口區", "深坑區", "石碇區", "坪林區", "三芝區",
            "石門區", "八里區", "平溪區", "雙溪區", "貢寮區", "金山區", "萬里區",
            "烏來區"],
        "桃園市": ["桃園區", "中壢區", "大溪區", "楊梅區", "蘆竹區", "大園區", "龜山區",
            "八德區", "龍潭區", "平鎮區", "新屋區", "觀音區", "復興區"],
        "新竹市": ["東區", "北區", "香山區"],
        "新竹縣": ["竹北市", "關西鎮", "新埔鎮", "竹東鎮", "湖口鄉", "橫山鄉", "新豐鄉",
            "芎林鄉", "寶山鄉", "北埔鄉", "峨眉鄉", "尖石鄉", "五峰鄉"],
        "苗栗縣": ["苗栗市", "頭份市", "苑裡鎮", "通霄鎮", "竹南鎮", "後龍鎮", "卓蘭鎮",
            "大湖鄉", "公館鄉", "銅鑼鄉", "南庄鄉", "頭屋鄉", "三義鄉", "西湖鄉",
            "造橋鄉", "三灣鄉", "獅潭鄉", "泰安鄉"],
        "臺中市": ["中區", "東區", "南區", "西區", "北區", "西屯區", "南屯區", "北屯區",
            "豐原區", "東勢區", "大甲區", "清水區", "沙鹿區", "梧棲區", "后里區",
            "神岡區", "潭子區", "大雅區", "新社區", "石岡區", "外埔區", "大安區",
            "烏日區", "大肚區", "龍井區", "霧峰區", "太平區", "大里區", "和平區"],
        "彰化縣": ["彰化市", "員林市", "鹿港鎮", "和美鎮", "北斗鎮", "溪湖鎮", "田中鎮",
            "二林鎮", "線西鄉", "伸港鄉", "福興鄉", "秀水鄉", "花壇鄉", "芬園鄉",
            "大村鄉", "埔鹽鄉", "埔心鄉", "永靖鄉", "社頭鄉", "二水鄉", "田尾鄉",
            "埤頭鄉", "芳苑鄉", "大城鄉", "竹塘鄉", "溪州鄉"],
        "南投縣": ["南投市", "埔里鎮", "草屯鎮", "竹山鎮", "集集鎮", "名間鄉", "鹿谷鄉",
            "中寮鄉", "魚池鄉", "國姓鄉", "水里鄉", "信義鄉", "仁愛鄉"],
        "雲林縣": ["斗六市", "斗南鎮", "虎尾鎮", "西螺鎮", "土庫鎮", "北港鎮", "古坑鄉",
            "大埤鄉", "莿桐鄉", "林內鄉", "二崙鄉", "崙背鄉", "麥寮鄉", "東勢鄉",
            "褒忠鄉", "臺西鄉", "元長鄉", "四湖鄉", "口湖鄉", "水林鄉"],
        "嘉義市": ["東區", "西區"],
        "嘉義縣": ["太保市", "朴子市", "布袋鎮", "大林鎮", "民雄鄉", "溪口鄉", "新港鄉",
            "六腳鄉", "東石鄉", "義竹鄉", "鹿草鄉", "水上鄉", "中埔鄉", "竹崎鄉",
            "梅山鄉", "番路鄉", "大埔鄉", "阿里山鄉"],
        "臺南市": ["新營區", "鹽水區", "白河區", "柳營區", "後壁區", "東山區", "麻豆區",
            "下營區", "六甲區", "官田區", "大內區", "佳里區", "學甲區", "西港區",
            "七股區", "將軍區", "北門區", "新化區", "善化區", "新市區", "安定區",
            "山上區", "玉井區", "楠西區", "南化區", "左鎮區", "仁德區", "歸仁區",
            "關廟區", "龍崎區", "永康區", "東區", "南區", "北區", "安南區", "安平區",
            "中西區"],
        "高雄市": ["鹽埕區", "鼓山區", "左營區", "楠梓區", "三民區", "新興區", "前金區",
            "苓雅區", "前鎮區", "旗津區", "小港區", "鳳山區", "林園區", "大寮區",
            "大樹區", "大社區", "仁武區", "鳥松區", "岡山區", "橋頭區", "燕巢區",
            "田寮區", "阿蓮區", "路竹區", "湖內區", "茄萣區", "永安區", "彌陀區",
            "梓官區", "旗山區", "美濃區", "六龜區", "甲仙區", "杉林區", "內門區",
            "茂林區", "桃源區", "那瑪夏區"],
        "屏東縣": ["屏東市", "潮州鎮", "東港鎮", "恆春鎮", "萬丹鄉", "長治鄉", "麟洛鄉",
            "九如鄉", "里港鄉", "鹽埔鄉", "高樹鄉", "萬巒鄉", "內埔鄉", "竹田鄉",
            "新埤鄉", "枋寮鄉", "新園鄉", "崁頂鄉", "林邊鄉", "南州鄉", "佳冬鄉",
            "琉球鄉", "車城鄉", "滿州鄉", "枋山鄉", "三地門鄉", "霧臺鄉", "瑪家鄉",
            "泰武鄉", "來義鄉", "春日鄉", "獅子鄉", "牡丹鄉"],
        "台東縣": ["臺東市", "成功鎮", "關山鎮", "卑南鄉", "大武鄉", "太麻里鄉", "東河鄉",
            "長濱鄉", "鹿野鄉", "池上鄉", "綠島鄉", "延平鄉", "海端鄉", "達仁鄉",
            "金峰鄉", "蘭嶼鄉"],
        "花蓮縣": ["花蓮市", "鳳林鎮", "玉里鎮", "新城鄉", "吉安鄉", "壽豐鄉", "光復鄉",
            "豐濱鄉", "瑞穗鄉", "富里鄉", "秀林鄉", "萬榮鄉", "卓溪鄉"],
        "宜蘭縣": ["宜蘭市", "羅東鎮", "蘇澳鎮", "頭城鎮", "礁溪鄉", "壯圍鄉", "員山鄉",
            "冬山鄉", "五結鄉", "三星鄉", "大同鄉", "南澳鄉"],
        "澎湖縣": ["馬公市", "湖西鄉", "白沙鄉", "西嶼鄉", "望安鄉", "七美鄉"],
        "金門縣": ["金城鎮", "金湖鎮", "金沙鎮", "金寧鄉", "烈嶼鄉", "烏坵鄉"],
        "連江縣": ["南竿鄉", "北竿鄉", "莒光鄉", "東引鄉"],

        // ... Add more counties and their areas ...
    };

    const countyDropdown = document.getElementById("city");
    const distDropdown = document.getElementById("dist");

    countyDropdown.addEventListener("change", function () {
        const selectedCounty = countyDropdown.value;
        const dists = distsByCounty[selectedCounty] || [];

        // Clear previous options
        distDropdown.innerHTML = '';

        if (dists.length > 0) {
            // Enable the area dropdown and populate options
            distDropdown.removeAttribute('disabled');
            dists.forEach(function (dist) {
                const option = document.createElement('option');
                option.value = dist;
                option.textContent = dist;
                distDropdown.appendChild(option);
            });
        } else {
            // If no areas for the selected county, disable the area dropdown
            distDropdown.setAttribute('disabled', true);
            const defaultOption = document.createElement('option');
            defaultOption.value = 'none';
            defaultOption.selected = true;
            defaultOption.textContent = '{{ __('Select an area') }}';
            distDropdown.appendChild(defaultOption);
        }
    });
</script>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
