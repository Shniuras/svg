<?php

class Tag {
    protected $name;
    protected $attributes;
    protected $textas;

    public function draw()
    {
        echo '<' . $this->name . " " ;
        foreach ($this->attributes as $attribute => $key){
            echo $attribute . "=" . "\"" . $key . "\"";
        }
        if(isset($this->textas)){
            echo ">" . $this->textas . " " . "</" . $this->name . ">";
        }else{
            echo " " . "/>";
        }
    }
}
class Points{
    public $x;
    public $y;

    public function __construct($x, $y)
    {
        $this->x = $x;
        $this->y = $y;
    }
}

class Text extends Tag{

    public function __construct($x, $y, $z)
    {
        $this->name = 'text';
        $this->attributes = [
            'x' => $x,
            'y' => $y
        ];
        $this->textas = $z;
    }
}

class Rectangle extends Tag{
    public function __construct($width, $height, $x, $y, $color)
    {
        $this->name = 'rect';
        $this->attributes = [
            'x'         =>  $x,
            'y'         =>  $y,
            'width'     =>  $width,
            'height'    =>  $height,
            'style'     =>  "fill:" . $color
        ];
    }
}

class Circle extends Tag{
    public function __construct($cx, $cy, $r, $color, $stroke, $strokeWidth)
    {
        $this->name = 'circle';
        $this->attributes = [
            'cx' => $cx,
            'cy' => $cy,
            'r'  => $r,
            'style'=> "fill:" . $color,
            'stroke' => $stroke,
            'stroke-width' => $strokeWidth
        ];
    }
}

class Triangle extends Tag {
    public function __construct($a, $b, $c, $color)
    {
        $this->name = 'polygon';
        $this->attributes = [
            'points' => $a->x . "," . $a->y . " " . $b->x . "," . $b->y . " " . $c->x . "," . $c->y,
            'style' => "fill:" . $color
        ];
    }
}

class Trapecija extends Tag {
    public function __construct($a, $b, $c, $d, $color)
    {
        $this->name = 'polygon';
        $this->attributes = [
            'points' => $a->x . "," . $a->y . " " . $b->x . "," . $b->y . " " . $c->x . "," . $c->y . " " . $d->x . "," . $d->y,
            'style' => "fill:" . $color
        ];
    }
}

class Trapecija2 extends Tag{

    public $rectangular;
    public $triangleR;
    public $triangleL;

    public function __construct($x, $y, $height, $widthTri, $widthRec, $color)
    {
        $startPointX = $x+($widthTri - $widthRec)/2;
        $startPointY = $y-$height;
        $endPointX = $x+$widthTri-($widthTri - $widthRec)/2;
        $endPointX2 = $x + $widthTri;

        // Keturkampis
        $rect = new Rectangle($widthRec, $height, $startPointX, $startPointY, $color);
        $this->rectangular = $rect;

        // Trikampis is kaires
        $trianL = new Triangle(new Points($x, $y), new Points($startPointX, $y), new Points($startPointX,$startPointY), $color);
        $this->triangleL = $trianL;

        // Trikampis is desines
        $trianR = new Triangle(new Points($endPointX, $y), new Points($endPointX, $startPointY), new Points($endPointX2, $y), $color);
        $this->triangleR = $trianR;

    }

    public function draw(){
        $this->rectangular->draw();
        $this->triangleL->draw();
        $this->triangleR->draw();
    }
}

// 1.
$rect = new Rectangle(250,150,400,250, "red");
$circle = new Circle (525, 325, 60, "green", "black", 1);
$triangle = new Triangle(new Points(200,400),new Points(400,250), new Points(400,400), "lime");
$triangle2 = new Triangle(new Points(650,250),new Points(650,400), new Points(850,400), "lime");
$firstText = new Text(478,328, "Labas Vakaras");

echo '<svg width="1000" height="500">';
$triangle->draw();
$rect->draw();
$triangle2->draw();
$circle->draw();
$firstText->draw();
echo '</svg>';
echo "<hr>";

// 2.
$trapecija = new Trapecija(new Points(450,0),new Points(650,0), new Points(800,400), new Points(300,400), "orange");
$secondText = new Text (490,100,"Piesiame trapecija");
echo '<svg width="1000" height="400">';
$trapecija->draw();
$secondText->draw();
echo '</svg>';
echo "<hr>";

// 2.1
$newTrapecija = new Trapecija2(50,150,500,600,300, "orange");
echo '<svg width="1000" height="400">';
echo $newTrapecija->draw();
echo '</svg>';

// 3.

