<?php
namespace Ijdb\Controllers;
use \Hanbit\DatabaseTable;

class Register {
	private $authorsTable;

	public function __construct(DatabaseTable $authorsTable) {
		$this->authorsTable = $authorsTable;
	}

	public function registrationForm() {
		return ['template' => 'register.html.php', 
				'title' => '사용자 등록'];
	}


	public function success() {
		return ['template' => 'registersuccess.html.php', 
			    'title' => '등록 성공'];
	}

	public function registerUser() {
		$author = $_POST['author'];

		// 데이터는 처음부터 유효하다고 가정
		$valid = true;
		$errors = [];

		// 하지만 항목이 빈 값이면 $valid에 false 할당
		if (empty($author['name'])) {
			$valid = false;
			$errors[] = '이름을 입력해야 합니다.';
		}

		if (empty($author['email'])) {
			$valid = false;
			$errors[] = '이메일을 입력해야 합니다.';
		}

		if (empty($author['password'])) {
			$valid = false;
			$errors[] = '비밀번호를 입력해야 합니다.';
		}

		// $valid가 true라면 빈 항목이 없으므로 데이터를 추가할 수 있음
		if ($valid == true) {
			$this->authorsTable->save($author);

			$this->authorsTable->save($author);

			header('Location: /author/success');
		}
		else {
			// 데이터가 유효하지 않으면 폼을 다시 출력
			return ['template' => 'register.html.php', 
				    'title' => '사용자 등록',
				    'variables' => [
				    	'errors' => $errors,
				    	'author' => $author
				    ]
				   ]; 
		}
	}
}