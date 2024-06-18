<?php

namespace App\Models;

use App\Models\ArticlesTranslate;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Comments;

class Article extends Model
{
    protected $guarded = [];
    public function translates()
    {
        return $this->hasMany(ArticlesTranslate::class);
    } 
    
    public static function store($request)
    {
        $item = new Article;

        // აქ ისე ვერ მოვხვდებით, რომ ფოტო არჩეული არ იყოს, მაგრამ მაინც გადავამოწმოთ :))
        if ($request->hasFile('image')) 
        {
            $destination = 'uploads/articles'; // სად ვტვირთავთ ფოტოს

            $extension = $request->file('image')->getClientOriginalExtension(); // ატვირთული ფაილის გაფართოება : jpeg,jpg,png

            $file_name = mt_rand(11111, 99999) . time() . '.' . $extension; // მაგ: 564564564564.jpg

            $file_src = '/' . $destination . '/'. $file_name; // მაგ: /uploads/articles/564564564564.jpg

            // თუ სამიზნე საქაღალდე არ არსებობს
            if (!file_exists($destination)) 
            {
                mkdir($destination, 0777, true); // შეიქმნება public/uploads/articles საქაღალდე
            }   

            $request->file('image')->move($destination, $file_name); // ფაილის ატვირთვა სამიზნე საქაღალდეში

            $item->image = $file_src; // image ველის განსაზღვრა მოდელის ობიექტისათვის
        }

        /* 
            სათარგმნი ინფორმაციების დამუშავების სქემა რომ უფრო მარტივი აღსაქმელი იყოს, 
            აქვე მოვიყვანოთ მაგალითი თუ რა სახით შედის ეს ინფორმაციები მოთხოვნის ტანში : 

            [translates] => Array
            (
                [ka] => Array
                    (
                        [title] => სატესტო სიახლის სათაური
                        [description] => სატესტო სიახლის აღწერა
                        [text] => სატესტო სიახლის სრული ტექსტი
                    )

                [en] => Array
                    (
                        [title] => Test article title
                        [description] => Test article description
                        [text] => Test article full text
                    )

            )
        */
        
        // თუ ჩანაწრი წარმატებით შეინახება articles ცხრილში
        if ($item->save()) 
        {
            // თარგმანების შემცველი ასცოციაციური მასივი ინდექსებით ka,en
            $translates = $request->translates;

            foreach ($translates as $lang => $translation_data) 
            {
                // სათარგმნი მოდელის ეგზემპლიარი თითოეული ენისათვის 
                $item_translate = new ArticlesTranslate;

                /*
                 *  უშუალოდ თარგმანების მასივი [ველის_დასახელება => თარგმანი_შესაბამის_ენაზე]
                 *  $k : ველის დასახელება, მაგ. 'title'
                 *  $v : თარგმანი შესაბამის ენაზე, მაგ. 'სათური'
                 */
                foreach($translation_data as $k => $v)
                {
                    /* 
                        თუ რომელიმე სათარგმნი ველი არ შეიყვანა ქართული ენის გარდა რომელიმე სხვა ენაზე
                        არაკრეფილის მნიშვნელობად ჩაჯდეს ქართული ენის შესაბამისი მნიშვნელობა, ქართულად 
                        ყველა შემთხვევაში აკრეფილი იქნება ინფორმაცია, რადგან ეს ვალიდაციაში გვაქვს მოთხოვნილი
                    */
                    if(!$v)
                    {
                        
                        $item_translate->$k = $translates['ka'][$k];
                    }
                    else
                    {
                        $item_translate->$k = $v;
                    }                   
                }                

                $item_translate->lang = $lang;
                $item_translate->article_id = $item->id;
                
                $item_translate->save(); // ჩანაწრის შენახვა articles_translates ცხრილში
            }

            return true;            
        }
        
        return false;
    }
    public static function all($local = null) 
    {
        return Article::join('articles_translates', 'articles.id', '=', 'articles_translates.article_id')
                ->where('articles_translates.lang', $local)
                ->select('articles.*', 'articles_translates.title', 'articles_translates.description')
                ->orderBy('id', 'desc')
                ->get();
    }
    public static function item($local = null, $id = null) 
    {
        return Article::join('articles_translates', 'articles.id', '=', 'articles_translates.article_id')
                ->where('articles.id', $id)
                ->where('articles_translates.lang', $local)
                ->select('articles.*', 'articles_translates.title','articles_translates.description','articles_translates.text')
                ->first();
    }
     

    public static function itemByIdWithTranslates($id = null) 
    {
        return Article::join('articles_translates', 'articles.id', '=', 'articles_translates.article_id')
                ->select('articles.*', 'articles_translates.title', 'articles_translates.description', 'articles_translates.text','articles_translates.lang')
                ->where('articles.id', $id)
                ->get();
    }
    public static function itemsByIdWithTranslates($local = null) 
    {
        return Article::join('articles_translates', 'articles.id', '=', 'articles_translates.article_id')
                ->where('articles_translates.lang', $local)
                ->select('articles.*', 'articles_translates.title', 'articles_translates.description', 'articles_translates.text')
                ->orderBy('id', 'desc')
                ->get();
    }
    
    public static function updateItem($request, $item)
    {
        if ($request->hasFile('image')) 
        {
            $destination = 'uploads/articles'; // სად ვტვირთავთ ფოტოს

            $extension = $request->file('image')->getClientOriginalExtension(); // ატვირთული ფაილის გაფართოება : jpeg,jpg,png

            $file_name = mt_rand(11111, 99999) . time() . '.' . $extension; // მაგ: 564564564564.jpg

            $file_src = '/' . $destination . '/'. $file_name; // მაგ: /uploads/articles/564564564564.jpg

            // თუ სამიზნე საქაღალდე არ არსებობს
            if (!file_exists($destination)) 
            {
                mkdir($destination, 0777, true); // შეიქმნება public/uploads/articles საქაღალდე
            }   

            $request->file('image')->move($destination, $file_name); // ფაილის ატვირთვა სამიზნე საქაღალდეში

            $item->image = $file_src; // image ველის განსაზღვრა მოდელის ობიექტისათვის
        }
        
        if ($item->update()) 
        {
            $translates = $request->translates;
            
            foreach ($translates as $lang => $translation_data) 
            {
                $item_translate = ArticlesTranslate::where('article_id', $item->id)->where('lang', $lang)->first();

                foreach($translation_data as $k => $v)
                {
                    if(!$v)
                    {
                        
                        $item_translate->$k = $translates['ka'][$k];
                    }
                    else
                    {
                        $item_translate->$k = $v;
                    }                   
                }                
                
                $item_translate->update(); // ჩანაწრის შენახვა articles_translates ცხრილში
            }

            return true;            
        }
        
        return false;  
    }
    public function comments()
    {
        return $this->hasMany(Comment::class);
    } 

   
}      

