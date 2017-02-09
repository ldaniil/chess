<?php

use entity\Game;
use entity\Figure;
use entity\repository\Builder as RepositoryBuilder;
use entity\figure\Builder as FigureBuilder;

spl_autoload_register(function ($className) {
	$file = str_replace('\\', DIRECTORY_SEPARATOR, $className) . '.php';

	if (file_exists($file)) {
		require_once $file;
	} else {
		throw new Exception("Невозможно загрузить $className");
	}
});

$repositoryBuilder = new RepositoryBuilder([
		'file' => [
			'directory' => __DIR__ . DIRECTORY_SEPARATOR . 'data',
		],
		'redis' => [

		],
	]
);

$config = [
	'repository' => $repositoryBuilder->createRepository('file'),
	'figureBuilder' => new FigureBuilder(),
	'figures'    => [
		'a2' => 'pawn',
		'd1' => 'queen',
		'e1' => 'king'
	],
	'callbackEvents' => [
		'addFigure'	=> function(Figure $figure){
			echo 'Добавлена фигура: ' . $figure->getName() . '<br />';
		},
		'addFigurePawn' => function(Figure $figure){
			echo 'На доску добавлена ' . $figure->getName() . '<br />';
		}
	],
];

$game = new Game($config);
$board = $game->getBoard();

$board->addFigure('pawn', 'e2');

$board->setEventCallback('addFigureQueen', function(Figure $figure){
	echo 'На доску добавлен ' . $figure->getName() . '<br />';
});

$board->addFigure('queen', 'e5');

$game->save();

$game->load();