package org.example;
import javax.swing.UnsupportedLookAndFeelException;
/**
 * see https://www.jc-mouse.net/
 * @author mouse
 */
public class Main {

    /**
     * @param args the command line arguments
     */
    public static void main(String[] args) {
        for (javax.swing.UIManager.LookAndFeelInfo info : javax.swing.UIManager.getInstalledLookAndFeels()) {
                if ("Windows".equals(info.getName())) {
                    try {
                        javax.swing.UIManager.setLookAndFeel(info.getClassName());
                        break;
                    } catch (ClassNotFoundException | InstantiationException | IllegalAccessException | UnsupportedLookAndFeelException ex) {
                        
                    }
                }
            }
        new JuegoFrm().setVisible(true);            
    }
    
}
