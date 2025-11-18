# Kargin Nyuton - PHP մեկնաբանությունների համակարգով

Հայերեն ֆիզիկայի ինտերակտիվ վիկտորինա PHP backend-ով։

## Նոր հնարավորություններ

✅ **Մեկնաբանությունների համակարգ PHP + JSON-ով**
- Մեկնաբանությունները պահպանվում են սերվերում (data/comments.json)
- Բոլոր օգտատերերը տեսնում են միևնույն մեկնաբանությունները
- Իրական ժամանակի ցուցադրում

✅ **Ջնջման ֆունկցիա գաղտնաբառով**
- Սեղմեք մեկնաբանության վրա՝ "Ջնջել" կոճակը տեսնելու համար
- Գաղտնաբառ՝ **Armidas**
- Եթե գաղտնաբառը սխալ է՝ մեկնաբանությունը չի ջնջվի

✅ **Instagram տեղափոխում վիդեո հետ**
- Սեղմեք Նյուտոնի նկարի վրա (header-ում)
- Նվագարկվում է Mti.MOV վիդեոն
- Վիդեո ավարտվելուց հետ բացվում է Instagram էջը

## Տեղակայում Replit-ում

1. Բոլոր ֆայլերը արդեն տեղի են՝ այս նախագծում
2. PHP սերվերը գործարկված է պորտ 5000-ում
3. Պարզապես սեղմեք Webview-ը՝ կայքը տեսնելու համար

## Տեղական օգտագործում

```bash
php -S localhost:5000 -t .
```

Այնուհետև բացեք՝ http://localhost:5000

## Ֆայլերի կառուցվածք

```
kargin-nyuton/
├── index.html              # Գլխավոր HTML ֆայլ (PHP API-ով)
├── manifest.json           # PWA manifest
├── vercel.json             # Vercel կոնֆիգուրացիա
├── .gitignore              # Git ignore
├── README-HY.md            # Այս ֆայլ
├── api/
│   └── comments.php        # PHP backend API
├── data/
│   └── comments.json       # Մեկնաբանությունների պահպանում
└── assets/                 # Վիդեո և նկարներ
    ├── Xndzor.png
    ├── Xndzor.MOV
    ├── Dasaran.MOV
    ├── Gir.MOV
    ├── Lav.MOV
    ├── Mti.MOV             # Instagram redirect վիդեո
    ├── Sxala.MOV
    ├── Sxala4.MOV
    └── Maladec5.MOV
```

## ⚠️ ԿԱՐԵՎՈՐ - Բացակայող վիդեոներ

Խաղում օգտագործվում են հետևյալ վիդեոները, որոնք դուք չեք տրամադրել՝

**Ճիշտ պատասխանների համար:**
- `assets/Xax.MOV` - Խաղի ներածություն
- `assets/Maladec1.MOV` - Հարց 2 ճիշտ պատասխան
- `assets/Maladec2.MOV` - Հարց 3 ճիշտ պատասխան
- `assets/Maladec3.MOV` - Հարց 4 ճիշտ պատասխան
- `assets/Maladec4.MOV` - Հարց 5 ճիշտ պատասխան

**Սխալ պատասխանների համար:**
- `assets/Sxala5.MOV` - Հարց 5 սխալ պատասխան
- `assets/Sxala6.MOV` - Հարց 6 սխալ պատասխան
- `assets/Vata.MOV` - Այլ սխալ պատասխաններ

Խաղը կաշխատի նաև առանց այս վիդեոների, բայց դրանք պետք են ավելացվեն ամբողջական փորձի համար։

## API Endpoints

### Մեկնաբանությունների ստացում
```
GET /api/comments.php
```

### Մեկնաբանություն ավելացնել
```
POST /api/comments.php
Content-Type: application/json

{
  "action": "add",
  "name": "Անուն",
  "comment": "Կարծիք"
}
```

### Մեկնաբանություն ջնջել
```
POST /api/comments.php
Content-Type: application/json

{
  "action": "delete",
  "id": "comment_id",
  "password": "Armidas"
}
```

## Տեխնոլոգիաներ

- **Frontend:** HTML5, CSS3, Vanilla JavaScript
- **Backend:** PHP 8.0+
- **Database:** JSON ֆայլ պահպանում
- **Server:** PHP Built-in Server

## Անվտանգություն

- Մեկնաբանությունները sanitized են XSS հարձակումներից պաշտպանելու համար
- Ջնջումը պաշտպանված է գաղտնաբառով
- CORS headers կոնֆիգուրված են

## Հեղինակային իրավունք

© 2025 «Kargin Nyuton» — Բոլոր իրավունքները պաշտպանված են։
