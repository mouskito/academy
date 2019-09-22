<?php

namespace Drupal\mouski\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Provides a 'TestBlock' block.
 *
 * @Block(
 *  id = "test_block",
 *  admin_label = @Translation("Test block"),
 * )
 */
class TestBlock extends BlockBase {
  /**
   * {@inheritdoc}
   */
  public function build() {
    return [
      '#markup' => $this->module1_block_content(),
      '#cache' => [
        'max-age' => 0
      ],
    ];
  }
  /**
   * Private function for getting random quote.
   */
  private function getRandQuote() {
    $quotes = [
      '<i>Whoever is happy will make others happy too.</i> Anne Frank',
      '<i>The secret of getting ahead is getting started.</i> Mark Twain',
      '<i>You can\'t blame gravity for falling in love.</i> Albert Einstein',
      '<i>The weak can never forgive. Forgiveness is the attribute of the strong.</i> Mahatma Gandhi'
    ];
    return $quotes[array_rand($quotes)];
  }

  public function module1_block_content(){
  if(\Drupal::currentUser()->isAuthenticated()){//Si l'utilisateur est loggé alors...
    global $user; //on récupère la variable global user pour ses informations
    dpm($user);
    $renderable_output[]= array('#markup' => t('Voici vos informations :'));
    $renderable_output[]=array('#markup' => t('Mon nom est ') . $user->name . ' .'); //on donne le nom d utilisateur
    $renderable_output[]=array('#markup' => t('Mon IP est ') . $user->hostname); // on donne l IP
    $roles_list=array();
    foreach($user->roles as $value ){ //on met les noms des roles dans un tableau
      $roles_list[] = array($value);
    }
    $renderable_output[]=array( //on créé le tableau contenant les infos pour le tableau des roles
      '#theme'=>'table',
      '#rows' => $roles_list,
      '#header' => array('Mes rôles sont :')
    );
  }
  else{ //si l utilisateur n'est pas loggé
    $renderable_output=array('#markup' => 'Merci de vous identifier ou de vous inscrire sur notre site');
  }
  //return $renderable_output;
  return $renderable_output;
}

}
