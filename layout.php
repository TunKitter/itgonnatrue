<!DOCTYPE html>
<html lang="vn">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?=$home_path?>/styles/index.css">
    <link rel="stylesheet" href="<?=$home_path?>/styles/<?= $style ?>.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <title><?= $title ?></title>
</head>

<body>
    
    <nav>
        <div id="logo" onclick="location.href = '../home/index.php'">IGT</div>
        <div id="search"><input placeholder="" type="text" spellcheck="false">
            <i class="fa-solid fa-magnifying-glass" style="font-size: 1.4em; color:var(--primary-color)"></i>
        </div>
        <div id="action">
            <button onclick="location.href = '../storage/index.php'">Kho từ vựng <sup style="background-color: #4481eb; color: white; padding: 4px; border-radius: 10% ">1</sup> </button>
            <button>Đăng nhập</button>
            <!-- <i class="fa-solid fa-user-astronaut" style="font-size: 1.7em ;color:var(--primary-color)"></i> -->
        </div>
    </nav>
    <aside>
        <div id="category" style="position: sticky ; top: 1em;">

            <ul style="cursor: pointer">
                <li id="list">Danh mục
                    <ul id="list_item">
                        <li># Food</li>
                        <li># Verb</li>
                        <li># Technology</li>
                        <li># Ocean</li>
                    </ul>
                </li>
                <li id="list">Sắp xếp theo
                    <ul id="list_item">
                        <li># Mới nhất</li>
                        <li># Lưu nhiều nhất</li>
                        <li># Xem gần đây</li>
                    </ul>
                </li>
            </ul>
            <div style="position: relative">
               <div id="top10" style="opacity: 1">
                    <ul>
                        <li>Hello</li>
                        <li>Abstract</li>
                        <li>Trial</li>
                        <li>Hacker</li>
                        <li>Something</li>
                        <li>Angular</li>
                        <li>Headshort</li>
                        <li>Training</li>
                        <li>Guitar</li>
                        <li>Name</li>
                    </ul>
                </div>
            </div>
        </div>
        <div>
        <?php
        require_once($include_file);
        ?>
        </div>
<script>
           rd = Math.random()
        if(rd > 0.7) {
            i = 0 
            text = 'Tìm kiếm từ vựng ngay . . .'
            var a = document.getElementsByTagName('input')[0];
            const inv = setInterval(() => {
                if(i < text.length) {
                    a.setAttribute('placeholder',a.getAttribute('placeholder')+text[i])
                    i++;
                }
                else {
                    clearInterval(inv)
                }
                
            }, 60);
        }
 
</script>