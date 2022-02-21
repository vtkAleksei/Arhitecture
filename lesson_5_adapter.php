<?php

class CircleAreaLib
{
   public function getCircleArea(int $diagonal)
   {
       $area = (M_PI * $diagonal**2)/4;

       return $area;
   }
}



class SquareAreaLib
{
   public function getSquareArea(int $diagonal)
   {
       $area = ($diagonal**2)/2;

       return $area;
   }
}



interface ISquare
{
function squareArea(float $sideSquare);
}



interface ICircle
{
function circleArea(float $circumference);
}




class SquareAreaAdapter implements ISquare
{
    private $squareAreaLib;
 
    public function __construct(SquareAreaLib $squareAreaLib)
    {
        $this->squareAreaLib = $squareAreaLib;
    }
 
    public function squareArea(float $sideSquare)
    {

        $diagonal = $sideSquare * (sqrt(2));
        return $this->squareAreaLib->getSquareArea($diagonal);
    }
}




class CircleAreaAdapter implements ICircle
{
    private $circleAreaLib;
 
    public function __construct(CircleAreaLib $circleAreaLib)
    {
        $this->circleAreaLib = $circleAreaLib;
    }
 
    public function circleArea(float $circumference)
    {

        $diagonal = $circumference / M_PI;
        return $this->circleAreaLib->getCircleArea($diagonal);
    }
}




$circumference = 100;
$circleAdapter = new CircleAreaAdapter(new CircleAreaLib());
echo $circleAdapter->circleArea($circumference);

$sideSquare = 100;
$squareAdapter = new SquareAreaAdapter(new SquareAreaLib());
echo $squareAdapter->squareArea($sideSquare);
