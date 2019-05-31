<?php

class QueenList
{
	private $result = [];

	public function sort($num)
	{
		$maxPositionNum = pow($num, 2);
		for ($i = 0; $i < $maxPositionNum; ++$i) {
			$queenAry = [];
			$data = [];
			for ($x = 0; $x < $num; ++$x) {
				$data[$x] = [];
				for ($y = 0; $y < $num ; ++$y) {
					$data[$x][$y] = 0;
				}
			}
			$status = $this->set($data, $i, $queenAry, $num);
			if ($status === true) {
				return ;
			}
		}
	}

	private function set($data, $startPosition, $queenAry, $needQueenQty)
	{
		$position = $this->findFirstPosition($data, $startPosition);
		if ($position === false) {
			return false;
		}
		$queenAry[] = $position;
		$data = $this->mark($data, $position);

		if (count($queenAry) == $needQueenQty) {
			$this->result[] = $data;
			return true;
		}

		$maxTotalNum = count($data[0]) * count($data);
		while ($startPosition < $maxTotalNum ) {
			$status = $this->set($data, $startPosition, $queenAry, $needQueenQty);
			if ($status === true) {
				return true;
			}
			$nextPosition = $this->findFirstPosition($data, $startPosition + 1);
			if ($nextPosition === false) {
				return false;
			}
			$startPosition = $nextPosition[0] * count($data[0]) + $nextPosition[1];
		}
		return false;
	}

	private function mark($data, $position)
	{
		$max = count($data) - 1;
		$data[$position[0]][$position[1]] = 'Q';
		$x = $position[0];
		$y = $position[1];
		while($x > 0) {
			$x--;
			$data[$x][$y] = 1;
		}
		$x = $position[0];
		$y = $position[1];
		while($y > 0) {
			$y--;
			$data[$x][$y] = 1;
		}
		$x = $position[0];
		$y = $position[1];
		while($x < $max) {
			$x++;
			$data[$x][$y] = 1;
		}
		$x = $position[0];
		$y = $position[1];
		while($y < $max) {
			$y++;
			$data[$x][$y] = 1;
		}
		$x = $position[0];
		$y = $position[1];
		while($x > 0 && $y > 1) {
			$x--;
			$y--;
			$data[$x][$y] = 1;
		}
		$x = $position[0];
		$y = $position[1];
		while($x > 0 && $y < $max) {
			$x--;
			$y++;
			$data[$x][$y] = 1;
		}
		$x = $position[0];
		$y = $position[1];
		while($x < $max && $y > 0) {
			$x++;
			$y--;
			$data[$x][$y] = 1;
		}
		$x = $position[0];
		$y = $position[1];
		while($x < $max && $y < $max) {
			$x++;
			$y++;
			$data[$x][$y] = 1;
		}
		return $data;
	}

	private function findFirstPosition($data, $startPosition)
	{
		foreach ($data as $x => $row) {
			foreach ($row as $y => $val) {
				if ($x * count($row) + $y < $startPosition) {
					continue;
				}
				if ($val === 0) {
					return [$x, $y];
				}
			}
		}
		return false;
	}

	private function show($data)
	{
		foreach ($data as $row) {
			foreach ($row as $val) {
				echo $val;
			}
			echo PHP_EOL;
		}
		echo PHP_EOL;
		echo PHP_EOL;
	}
	public function showAll()
	{
		foreach ($this->result as $data) {
			$this->show($data);
		}
	}
}
$i = $argv[1];


$t = new QueenList;
$t->sort($i);
$t->showAll();
