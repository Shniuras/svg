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
    public function __construct($width, $height, $x, $y)
    {
        $this->name = 'rect';
        $this->attributes = [
            'x'         =>  $x,
            'y'         =>  $y,
            'width'     =>  $width,
            'height'    =>  $height,
            'style'     => 'fill:red'
        ];
    }
}

class Circle extends Tag{
    public function __construct($cx, $cy, $r)
    {
        $this->name = 'circle';
        $this->attributes = [
            'cx' => $cx,
            'cy' => $cy,
            'r'  => $r,
            'style'=> 'fill:green',
            'stroke' => 'black',
            'stroke-width' => 1
        ];
    }
}

class Triangle extends Tag {
    public function __construct($a, $b, $c)
    {
        $this->name = 'polygon';
        $this->attributes = [
            'points' => $a->x . "," . $a->y . " " . $b->x . "," . $b->y . " " . $c->x . "," . $c->y,
            'style' => 'fill:lime'
        ];
    }
}

class Trapecija extends Tag {
    public function __construct($a, $b, $c, $d)
    {
        $this->name = 'polygon';
        $this->attributes = [
            'points' => $a->x . "," . $a->y . " " . $b->x . "," . $b->y . " " . $c->x . "," . $c->y . " " . $d->x . "," . $d->y,
            'style' => "fill:orange"
        ];
    }
}

class Trapeze extends Tag{
    public function __construct()
    {

    }
}
// 1.
$rect = new Rectangle(250,150,400,250);
$circle = new Circle (525, 325, 60);
$triangle = new Triangle(new Points(200,400),new Points(400,250), new Points(400,400));
$triangle2 = new Triangle(new Points(650,250),new Points(650,400), new Points(850,400));
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
$trapecija = new Trapecija(new Points(450,0),new Points(650,0), new Points(800,400), new Points(300,400));
$secondText = new Text (490,100,"Piesiame trapecija");
echo '<svg width="1000" height="400">';
$trapecija->draw();
$secondText->draw();
echo '</svg>';
echo "<hr>";

