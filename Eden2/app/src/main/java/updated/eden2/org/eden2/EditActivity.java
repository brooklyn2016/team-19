package updated.eden2.org.eden2;

import android.content.Intent;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.view.View;

public class EditActivity extends AppCompatActivity {

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_edit);
    }

    protected void goToResultsAct(View v) {
        Intent intent = getIntent();
        String toEdit = intent.getStringExtra("STRING_FROM_SERVER");
        String[] texts = toEdit.split(" ");
        //TODO: create texts.length number of textfields
        //TODO: post to server
        finish();
    }
}